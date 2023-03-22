<?php

namespace Core\Config;

class Request
{

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
}