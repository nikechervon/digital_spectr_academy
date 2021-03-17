<?php

// Errors
error_reporting(E_ALL);
ini_set('display_errors',true);

// Require composer autoload
require __DIR__ . '/vendor/autoload.php';

use App\Application;
use Bramus\Router\Router;

$router = new Router();

// Routes file
require __DIR__ . '/routes.php';

// Run Application
$application = new Application($router);
$application->run();
