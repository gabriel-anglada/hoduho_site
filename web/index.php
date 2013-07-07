<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Controller\MainController;
use Controller\ServicesController;
use Silex\Provider\FormServiceProvider;
use Services\EmailService;

$app = new Silex\Application();

//Config
$app['debug'] = true;
$app['infoMail'] = 'gabriel.anglada@hoduho.es';

//Register services
$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallback' => 'es',
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../src/Resources/views',
));

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app['mainController'] = $app->share(function() use ($app) {
    return new MainController($app);
});
$app['servicesController'] = $app->share(function() use ($app) {
    return new ServicesController($app);
});

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

//Mail
$app['swiftmailer.options'] = array(
    'host' => 'mail.hoduho.es',
    'port' => '25',
    'username' => 'gabriel.anglada@hoduho.es',
    'password' => 'hodX9211',
    'encryption' => null,
    'auth_mode' => null
);
$app['mailer.custom'] = $app->share(function() use ($app) {
    return new EmailService($app);
});


//Routing
$app->get('/', function() use ($app) {
    return $app->redirect('/presentacion');
});
$app->get('/presentacion', "mainController:homeAction");
$app->get('/servicios/{type}', "servicesController:servicesAction")
    ->value('type', null);
$app->get('/puntos', "mainController:pointsAction");
$app->get('/trabaja', "mainController:workWithUsAction");
$app->match('/contacta', "mainController:contactUsAction");

$app->run();
