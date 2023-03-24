<?php
namespace Core\Config;

use JetBrains\PhpStorm\NoReturn;

class Redirect extends Session
{
    #[NoReturn] public static function to($url)
    {
        Header::set('Location', $url);
        exit();
    }

    #[NoReturn] public static function back()
    {
        $referer = Header::getServer('HTTP_REFERER') ?? '/';
        Header::set('Location', $referer);
        exit();
    }

    public static function with($key, $value)
    {
        static::start();
        static::set("flash_data.$key", $value);
    }

    public static function getFlashData($key)
    {
        static::start();
        $value = static::get("flash_data.$key");
        static::delete("flash_data.$key");
        return $value;
    }
}