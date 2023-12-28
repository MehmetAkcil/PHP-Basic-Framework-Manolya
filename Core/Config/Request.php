<?php

namespace Core\Config;

class Request
{

    public static function get($name = false)
    {
        if($name){
            return $_GET[$name] ?? false;
        }else{
            return $_GET;
        }
    }

    public static function post($name = false)
    {
        if($name){
            return $_POST[$name] ?? false;
        }else{
            return $_POST;
        }
    }

    public static function request($name = false)
    {
        $jsonData = json_decode(file_get_contents("php://input"), true);
        if($name){
            return $jsonData[$name] ?? false;
        }else{
            return $jsonData;
        }

    }
}
