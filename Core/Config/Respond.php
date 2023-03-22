<?php
namespace Core\Config;

class Respond{

    public static function response(Int $status, Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode($data);
    }

    public static function respond(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(200);
        return json_encode($data);
    }

    public static function responseCreate(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(201);
        return json_encode($data);
    }

    public static function responseBad(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(400);
        return json_encode($data);
    }

    public static function responseNotFound(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(404);
        return json_encode($data);
    }

    public static function responseAuth(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(401);
        return json_encode($data);
    }

    public static function responseDelete(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(204);
        return json_encode($data);
    }

    public static function responseServerError(Array $data): false|string
    {
        header('Content-Type: application/json');
        http_response_code(500);
        return json_encode($data);
    }

}