<?php

class Respond{

    public static function get($name)
    {
        return $_GET[$name] ?? false;
    }

    public static function post($name)
    {
        return $_POST[$name] ?? false;
    }

    public static function request($name)
    {
        parse_str(file_get_contents('php://input'), $_REQ);
        return $_REQ[$name] ?? false;
    }

    public static function response($status, $data)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode($data);
    }

    public static function responseCreate($data)
    {
        header('Content-Type: application/json');
        http_response_code(201);
        return json_encode($data);
    }

    public static function responseBad($data)
    {
        header('Content-Type: application/json');
        http_response_code(400);
        return json_encode($data);
    }

    public static function responseNotFound($data)
    {
        header('Content-Type: application/json');
        http_response_code(404);
        return json_encode($data);
    }

    public static function responseAuth($data)
    {
        header('Content-Type: application/json');
        http_response_code(401);
        return json_encode($data);
    }

    public static function responseDelete($data)
    {
        header('Content-Type: application/json');
        http_response_code(204);
        return json_encode($data);
    }

    public static function responseServerError($data)
    {
        header('Content-Type: application/json');
        http_response_code(500);
        return json_encode($data);
    }

}