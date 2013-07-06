<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Controller\MainController;
use Controller\ServicesController;

$app = new Silex\Application();
$app['debug'] = true;

//Register the twig service
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../src/Resources/views',
));

//Register the controllers
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app['mainController'] = $app->share(function() use ($app) {
    return new MainController($app);
});
$app['servicesController'] = $app->share(function() use ($app) {
    return new ServicesController($app);
});


//Routing
$app->get('/', function() use ($app) {
    return $app->redirect('/presentacion');
});
$app->get('/presentacion', "mainController:homeAction");
$app->get('/servicios/{type}', "servicesController:servicesAction")
    ->value('type', null);
$app->get('/servicios/promos/{type}', "servicesController:promoServicesAction");
$app->get('/puntos', "mainController:pointsAction");
$app->get('/trabaja', "mainController:workWithUsAction");
$app->get('/contacta', "mainController:contactUsAction");

$app->run();
