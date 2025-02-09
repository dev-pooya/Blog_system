<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\PostController;
use App\Controllers\AdminController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\GuestMiddleware;

/** @var \App\Core\App $app */

// Public routes
$app->router->get('/', [HomeController::class, 'index']);

// Guest-only routes (for non-authenticated users)
$app->router->get('/login', [AuthController::class, 'loginForm'], [GuestMiddleware::class]);
$app->router->post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
$app->router->get('/register', [AuthController::class, 'registerForm'], [GuestMiddleware::class]);
$app->router->post('/register', [AuthController::class, 'register'], [GuestMiddleware::class]);

// Authenticated routes
$app->router->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

// Post routes
$app->router->get('/posts/{slug}', [PostController::class, 'show']);

// Admin routes
$app->router->get('/admin', [AdminController::class, 'dashboard'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->get('/admin/posts/create', [AdminController::class, 'createPost'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->post('/admin/posts', [AdminController::class, 'storePost'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->get('/admin/posts/{id}/edit', [AdminController::class, 'editPost'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->post('/admin/posts/{id}', [AdminController::class, 'updatePost'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->post('/admin/posts/{id}/delete', [AdminController::class, 'deletePost'], [AuthMiddleware::class, AdminMiddleware::class]);

// Admin user management routes
$app->router->get('/admin/users', [AdminController::class, 'users'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->post('/admin/users/{id}/toggle-admin', [AdminController::class, 'toggleAdmin'], [AuthMiddleware::class, AdminMiddleware::class]);
$app->router->post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'], [AuthMiddleware::class, AdminMiddleware::class]); 