<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/app/routes/main.php');

use App\Core\Core;
use App\Http\Route;

Core::dispatchRoutes(Route::routes());
