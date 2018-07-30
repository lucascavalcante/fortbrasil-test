<?php

require_once __DIR__ . '/../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");

use Symfony\Component\HttpFoundation\Request;
use FortBrasil\CustomerModule\Controller\CustomerController;
use FortBrasil\BaseModule\Controller\BaseController;

$app = new Silex\Application();
$app->register(new Silex\Provider\ValidatorServiceProvider());

// exception treatment
$app->error(function (\Exception $e, Request $request, $code) {
    return BaseController::managingRoutes($request, [$code => $e->getMessage()]);
});

// ALL ROUTES

// default route
$app->get('/', function(Request $request) use ($app) {
    return BaseController::managingRoutes($request, ['App' => 'FortBrasil Test', 'Version' => '0.0.1']);
});

$app->match('/customer', function (Request $request) use ($app) {
    return CustomerController::managingRoutes($request, $app);
});

$app->match('/customer/{id}', function (Request $request) use ($app) {
    //return new \Symfony\Component\HttpFoundation\JsonResponse($request->request->get('_method'));
    return CustomerController::managingRoutes($request, $app);
});

$app->run();