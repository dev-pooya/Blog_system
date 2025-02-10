<?php

require_once __DIR__ . '/../vendor/autoload.php';

// make sure Dotenv is loaded before requiring the migration file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

require_once __DIR__ . '/../database/migrations/init.php'; 