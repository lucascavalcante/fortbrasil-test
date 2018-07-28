<?php

date_default_timezone_set('America/Sao_Paulo');
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app->get('/', function(Request $request) use ($app) {
    return json_encode([
        'App' => 'FortBrasil Test',
        'Version' => '0.0.1'
    ]);
});

$app->run();