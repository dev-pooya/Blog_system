<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Initialize the application
$app = new App\Core\App();

// Register routes
require_once __DIR__ . '/../routes/web.php';

// Run the application
$app->run(); 