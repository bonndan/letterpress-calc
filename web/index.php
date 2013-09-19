<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__) . '/views',
));

$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallback' => 'de',
));

$app['translator.domains'] = array(
    'messages' => array(
        'de' => array(
            Letterpress\GangRun::FOLD_ALONG_WIDTH     => 'quer (parallel zur Breite)',
            Letterpress\GangRun::FOLD_ALONG_LENGTH    => 'längs (parallel zur Länge)',
            'short grain' => 'Schmalbahn (Faser parallel zur Länge)',
            'long grain' => 'Breitahn (Faser parallel zur Breite)',
        ),
    ),
);

/*
 * business logic
 */
require_once dirname(__DIR__) . '/config/config.php';
$app['letterpress'] = new Letterpress\Application($app, $config);

$app->get('/', function () use ($app) {
    
    $paper = new \Letterpress\PaperSheet('Superpapier nonplusultra', 700, 300, \Letterpress\PaperSheet::SHORT_GRAIN);
    $gangrun = new \Letterpress\GangRun(80, 40);
    $gangrun->setFoldedDimensions(40, 40);
    
    $layout  = $app['letterpress']->getLayoutFor($paper, $gangrun);
    $layout2 = $app['letterpress']->getLayoutFor($paper, $gangrun->rotate());
    
    return $app['twig']->render('index.html.twig', array(
        'form'    => $app['letterpress']->getForm()->createView(),
        'paper'   => $paper,
        'gangrun' => $gangrun,
        'layout'  => $layout,
        'layout2' => $layout2,
    ));
});

$app->run();
