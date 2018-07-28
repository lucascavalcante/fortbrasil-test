<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use FortBrasil\CustomerModule\Controller\CustomerController;
use FortBrasil\BaseModule\Controller\BaseController;

$app = new Silex\Application();
$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->error(function (\Exception $e, Request $request, $code) {
    return BaseController::managingRoutes($request, [$code => $e->getMessage()]);
});

$app->get('/', function(Request $request) use ($app) {
    return BaseController::managingRoutes($request, ['App' => 'FortBrasil Test', 'Version' => '0.0.1']);
});

// return all customers
$app->get('/customer', function (Request $request){
    return CustomerController::managingRoutes($request);
});

// return a specific customer
$app->get('/customer/{id}', function (Request $request){
    return CustomerController::managingRoutes($request);
});

// save new customer
$app->post('/customer', function (Request $request) use ($app) {
    return CustomerController::managingRoutes($request, $app);
});

// edit a specific customer
$app->put('/customer/{id}', function (Request $request) use ($app) {
    return CustomerController::managingRoutes($request, $app);
});

// delete a specific customer
$app->delete('/customer/{id}', function (Request $request){
    return CustomerController::managingRoutes($request);
});

$app->run();