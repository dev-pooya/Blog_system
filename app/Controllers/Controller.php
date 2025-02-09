<?php

namespace App\Controllers;

abstract class Controller
{
    protected function view(string $name, array $data = []): void
    {
        // Start output buffering
        ob_start();
        
        // Extract data for the view
        extract($data);
        
        // Include the view file
        require_once __DIR__ . "/../Views/{$name}.php";
        
        // Get the content
        $content = ob_get_clean();
        
        // Include the layout
        require_once __DIR__ . "/../Views/layouts/main.php";
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
} 