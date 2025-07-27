<?php

namespace App\Http;

class Route
{
    private static $routes = [];

    public static function get($path, $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET'
        ];
    }

    public static function post($path, $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'POST'
        ];
    }

    public static function put($path, $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'PUT'
        ];
    }

    public static function delete($path, $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'DELETE'
        ];
    }

    public static function routes()
    {
        return self::$routes;
    }
}
