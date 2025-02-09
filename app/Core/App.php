<?php

namespace App\Core;

class App
{
    public static DependencyContainer $container;
    public Router $router;

    public function __construct()
    {
        self::$container = new DependencyContainer();
        $this->router = new Router();
        
        // Register core services
        self::$container->register('db', function() {
            return Database::getInstance();
        });
    }

    public function run(): void
    {
        $this->router->resolve();
    }
} 