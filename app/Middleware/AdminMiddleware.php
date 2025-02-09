<?php

namespace App\Middleware;

use App\Core\Auth;

class AdminMiddleware
{
    public function handle(): void
    {
        if (!Auth::isAdmin()) {
            $_SESSION['error'] = 'You do not have permission to access this page';
            header('Location: /');
            exit;
        }
    }
} 