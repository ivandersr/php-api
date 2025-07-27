<?php

namespace App\Models;

use PDO;

class User extends Model
{
    public static function save(array $data)
    {
        $pdo = self::connect();
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)
        ");

        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }

    public static function authenticate(array $data)
    {
        $pdo = self::connect();

        $stmt = $pdo->prepare("
            SELECT id, name, email, password FROM users WHERE email = :email
        ");

        $stmt->execute([
            'email' => $data['email']
        ]);

        if ($stmt->rowCount() < 1) return false;

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($data['password'], $user['password'])) return false;
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }

    public static function find(int|string $id)
    {
        $pdo = self::connect();
        $stmt = $pdo->prepare("
            SELECT id, name, email FROM users WHERE id = :id
        ");
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
