<?php

namespace App\Http\Controllers;

use App\Http\{Request, Response};

class MainController
{
    public function index(Request $request, Response $response)
    {
        echo "Hello world!";
    }
}
