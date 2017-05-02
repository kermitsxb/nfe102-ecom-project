<?php
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/config.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';


// Run app
$app->run();


//$di = require_once(__DIR__ . '/../src/bootstrap.php');
//
//// Create application
//
//$app = new App($di->get('settings'));
//$container = $app->getContainer();
//$di->set('container', $container);
//
//$container['index'] = function () use ($di) {
//    return $di->newInstance(Application\Controller\Hello::class);
//};
//
//
