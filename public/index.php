<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

// load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// initialize the application
$app = new App\Core\App();

// register routes
require_once __DIR__ . '/../routes/web.php';

// run the application
$app->run(); 