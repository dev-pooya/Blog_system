<?php

namespace App\Controllers;

abstract class Controller
{
    protected function view(string $name, array $data = []): void
    {
        // start output buffering
        ob_start();
        
        // extract data for the view
        extract($data);
        
        // iinclude the view file
        require_once __DIR__ . "/../Views/{$name}.php";
        
        // get the content
        $content = ob_get_clean();
        
        // include the layout
        require_once __DIR__ . "/../Views/layouts/main.php";
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
} 