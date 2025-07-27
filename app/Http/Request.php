<?php

namespace App\Http;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function body()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];
        $debugFile = fopen('test.txt', 'w');
        fwrite($debugFile, json_encode($json));
        $data = match (self::method()) {
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json
        };

        return $data;
    }
}
