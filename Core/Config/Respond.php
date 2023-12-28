<?php
namespace Core\Config;

class Respond{

    public static function response(Int $status, $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode($data);
    }

    public static function responseSuccess($data): bool|string
    {
        header('Content-Type: application/json');
        http_response_code(200);
        return json_encode($data);
    }

    public static function responseCreate($data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(201);
        return json_encode($data);
    }

    public static function responseBad($data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(400);
        return json_encode($data);
    }

    public static function responseNotFound($data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(404);
        return json_encode($data);
    }

    public static function responseAuth($data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(401);
        return json_encode($data);
    }

    public static function responseDelete($data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(204);
        return json_encode($data);
    }

    public static function responseServerError($data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(500);
        return json_encode($data);
    }

}
