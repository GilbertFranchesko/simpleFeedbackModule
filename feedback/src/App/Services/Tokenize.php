<?php

namespace App\Services;

use App\Model\TokenModel;

class Tokenize
{

    public static function generateToken($playload)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($playload);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    public static function saveToken($token, $userID)
    {
        $model = new TokenModel();
        $createParams = array(
            "access" => $token,
            "user_id" => $userID
        );
        return $model->create($createParams);
    }

    public static function authorization($token)
    {
        $model = new TokenModel();
        $result = $model->getWhere("access", $token);
        return $result['id'];
    }
}