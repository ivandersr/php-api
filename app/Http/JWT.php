<?php

namespace App\Http;

class JWT
{
    private static string $secret = 'secret-key';

    public static function generate(array $data = [])
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($data);

        $encodedHeader = self::base64url_encode($header);
        $encodedPayload = self::base64url_encode($payload);
        $signature = self::base64url_encode(self::signature($encodedHeader, $encodedPayload));

        return $encodedHeader . '.' . $encodedPayload . '.' . $signature;
    }

    public static function signature(string $header, string $payload)
    {
        return hash_hmac('sha256', $header . '.' . $payload, self::$secret, true);
    }

    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
