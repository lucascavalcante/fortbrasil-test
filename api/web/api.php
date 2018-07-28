<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Silex\Application();

$app->error(function (\Exception $e, Request $request, $code) {
    return new JsonResponse([$code => $e->getMessage()]);
});

$app->get('/', function(Request $request) use ($app) {
    return new JsonResponse([
        'App' => 'FortBrasil Test',
        'Version' => '0.0.1'
    ]);
});

$app->run();