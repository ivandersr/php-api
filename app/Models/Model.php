<?php

namespace App\Models;

use PDO;

class Model
{
    public static function connect()
    {
        $pdo = new PDO("mysql:host=php-db-1;port=3306;dbname=api;charset=utf8", "admin", "admin", []);
        return $pdo;
    }
}
