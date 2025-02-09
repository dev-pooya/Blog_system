<?php

namespace App\Core;

class DependencyContainer
{
    private array $services = [];

    public function register(string $name, $service): void
    {
        $this->services[$name] = $service;
    }

    public function resolve(string $name)
    {
        if (!isset($this->services[$name])) {
            throw new \Exception("Service {$name} not found in container");
        }

        $service = $this->services[$name];
        return is_callable($service) ? $service($this) : $service;
    }
} 