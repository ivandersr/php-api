<?php

namespace App\Http\Controllers;

use App\Http\{Request, Response};

class NotFoundController
{
    public function index(Request $request, Response $response)
    {
        $response::json(['error' => 'Not found'], 404);
        return;
    }
}
