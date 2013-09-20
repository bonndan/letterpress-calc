<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__) . '/views',
    'twig.form.templates'   => array('form_div_layout.html.twig'),
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
            'Paper' => 'Papier',
            'Colors' => 'Farben',
            'Shape length' => 'Länge des Endformats (mm)',
            'Shape width' => 'Breite des Endformats (mm)',
            'Fold length' => 'Gefältete Länge (mm)',
            'Fold width' => 'Gefältete Breite (mm)',
            'Prints' => 'Anzahl der Excemplare',
            'Forms' => 'Anzahl der Formen',
            'Count' => 'Menge',
            'Description' => 'Beschreibung',
            'Price' => 'Einzelpreis',
            'Sum' => 'Preis',
        ),
    ),
);

/*
 * business logic
 */
require_once dirname(__DIR__) . '/config/config.php';
$app['letterpress'] = new Letterpress\Application($app, $config);

/**
 * Index Action
 * 
 * 
 * 
 */
$app->match('/', function (Request $request) use ($app) {
    
    $letterpress = $app['letterpress']; /* @var $letterpress \Letterpress\Application */
    $form = $letterpress->getForm();
    $form->bind($request);
    
    if ($request->isMethod('POST')) {
        $data  = $form->getData();
        $paper = $letterpress->getPaper($data['paper']);
        $gangrun = new \Letterpress\GangRun($data['shape_length'], $data['shape_width']);
        if ($data['fold_length'] != 0) {
            $gangrun->setFoldedDimensions($data['fold_length'], $data['fold_width']);
        }
        
        $layout  = $letterpress->getLayoutFor($paper, $gangrun);
        $layout2 = $letterpress->getLayoutFor($paper, $gangrun->rotate());
        $order   = $letterpress->createOrder();
        $order->setForms($data['forms']);
        $order->setColors($data['colors']);
        $order->countSheets($paper, $data['prints'], $layout, $layout2);
    }
    
    
    return $app['twig']->render('index.html.twig', array(
        'form'    => $form->createView(),
        'paper'   => $paper,
        'gangrun' => $gangrun,
        'layout'  => $layout,
        'layout2' => $layout2,
        'order'   => $order,
    ));
})->method('GET|POST');

$app->run();
