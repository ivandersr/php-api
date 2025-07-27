<?php

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;

class UserService
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name' => $data['name']  ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if (!$user) return ['error' => 'Sorry, could not create user'];
            return ['message' => 'User created successfully'];
        } catch (PDOException $e) {
            if ($e->errorInfo[0] === 'HY000') return ['error' => 'Sorry, could not connect to database'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Email already exists'];
            return ['error' => $e->getMessage()];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public static function auth(array $data)
    {
        try {
            $fields = Validator::validate([
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $user = User::authenticate($fields);
            if (!$user) return ['error' => 'Invalid credentials'];
            return JWT::generate($user);
            return $user;
        } catch (PDOException $e) {
            if ($e->errorInfo[0] === 'HY000') return ['error' => 'Sorry, could not connect to database'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
