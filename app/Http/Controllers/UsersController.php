<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;
use App\Utils\Validator;

class UsersController
{
    public function store(Request $request, Response $response)
    {
        $body = $request::body();
        $data = UserService::create($body);

        if (isset($data['error'])) {
            return $response::json([
                'error' => $data['error'],
            ], 400);
        }

        return $response::json([
            'data' => $data
        ], 201);
    }

    public function login(Request $request, Response $response)
    {
        $body = $request::body();
        $data = UserService::auth($body);

        if (isset($data['error'])) {
            return $response::json([
                'error' => $data['error'],
            ], 400);
        }

        return $response::json([
            'jwt' => $data
        ]);
    }

    public function show(Request $request, Response $response) {}

    public function update(Request $request, Response $response) {}

    public function delete(Request $request, Response $response, array $id) {}
}
