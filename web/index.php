<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__) . '/views',
));

$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
/*
 * business logic
 */
require_once dirname(__DIR__) . '/config/config.php';
$app['letterpress'] = new Letterpress\Application($app, $config);

$app->get('/', function () use ($app) {
    
    $paper = new \Letterpress\PaperSheet('Superpapier nonplusultra', 700, 300, \Letterpress\PaperSheet::LONG_GRAIN);
    $gangrun = new \Letterpress\GangRun(80, 40);
    $layout = new \Letterpress\Layout($paper, $gangrun);
    
    return $app['twig']->render('index.html.twig', array(
        'form'    => $app['letterpress']->getForm()->createView(),
        'paper'   => $paper,
        'gangrun' => $gangrun,
        'layout'  => $layout,
    ));
});

$app->run();
