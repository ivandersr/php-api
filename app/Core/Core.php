<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core
{
    public static function dispatchRoutes(array $routes)
    {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'App\\Http\\Controllers\\';
        $routeFound = false;

        foreach ($routes as $route) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                $routeFound = true;
                array_shift($matches);

                if ($route['method'] !== Request::method()) {
                    echo Request::method();
                    Response::json([
                        'error' => 'Method not allowed'
                    ], 405);
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);
                $controller = $prefixController . $controller;
                $extendedController = new $controller();
                $extendedController->$action(new Request, new Response, $matches);
            }
        }

        if (!$routeFound) {
            $controller = $prefixController . 'NotFoundController';
            $extendedController = new $controller();
            $extendedController->index(new Request, new Response);
        }
    }
}
