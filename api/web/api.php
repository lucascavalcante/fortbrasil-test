<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FortBrasil\CustomerModule\Controller\CustomerController;

$app = new Silex\Application();

$app->error(function (\Exception $e, Request $request, $code) {
    return new JsonResponse([$code => $e->getMessage()]);
});

$app->get('/', function() use ($app) {
    return new JsonResponse([
        'App' => 'FortBrasil Test',
        'Version' => '0.0.1'
    ]);
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
$app->post('/customer', function (Request $request){
    return CustomerController::managingRoutes($request);
});

// edit a specific customer
$app->put('/customer/{id}', function (Request $request){
    return CustomerController::managingRoutes($request);
});

// delete a specific customer
$app->delete('/customer/{id}', function (Request $request){
    return CustomerController::managingRoutes($request);
});

$app->run();