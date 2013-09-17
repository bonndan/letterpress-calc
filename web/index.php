<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// definitions
$app['debug'] = true;

require_once dirname(__DIR__) . '/config/config.php';

$app->get('/', function () {
    $output = 'Letterpress';
    return $output;
});

$app->run();
