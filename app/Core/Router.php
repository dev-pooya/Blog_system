<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function get(string $path, array $callback, array $middleware = []): void
    {
        $this->routes['GET'][$path] = $callback;
        if (!empty($middleware)) {
            $this->middlewares['GET'][$path] = $middleware;
        }
    }

    public function post(string $path, array $callback, array $middleware = []): void
    {
        $this->routes['POST'][$path] = $callback;
        if (!empty($middleware)) {
            $this->middlewares['POST'][$path] = $middleware;
        }
    }

    private function matchRoute(string $requestPath, string $routePath): ?array
    {
        $routeParts = explode('/', trim($routePath, '/'));
        $requestParts = explode('/', trim($requestPath, '/'));

        if (count($routeParts) !== count($requestParts)) {
            return null;
        }

        $params = [];
        for ($i = 0; $i < count($routeParts); $i++) {
            if (preg_match('/^{(.+)}$/', $routeParts[$i], $matches)) {
                $params[$matches[1]] = $requestParts[$i];
            } elseif ($routeParts[$i] !== $requestParts[$i]) {
                return null;
            }
        }

        return $params;
    }

    public function resolve()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($path, PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $routePath => $callback) {
            $params = $this->matchRoute($path, $routePath);
            if ($params !== null) {
                // Check middlewares
                if (isset($this->middlewares[$method][$routePath])) {
                    foreach ($this->middlewares[$method][$routePath] as $middleware) {
                        $middlewareInstance = new $middleware();
                        $middlewareInstance->handle();
                    }
                }

                if (is_array($callback)) {
                    $controller = new $callback[0]();
                    $method = $callback[1];
                    return $controller->$method(...array_values($params));
                }

                return call_user_func($callback, ...$params);
            }
        }

        http_response_code(404);
        require_once __DIR__ . '/../Views/errors/404.php';
    }
} 