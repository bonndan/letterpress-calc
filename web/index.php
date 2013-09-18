<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__) . '/views',
));

/*
 * business logic
 */
require_once dirname(__DIR__) . '/config/config.php';

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array(
    ));
});

$app->run();
