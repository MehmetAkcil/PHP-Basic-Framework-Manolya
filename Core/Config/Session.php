<?php
namespace Core\Config;

class Session
{
    public static function start(): void
    {
        session_start();
    }

    public static function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }
    public static function has($key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function delete($key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }

    public static function setFlashData($key, $value): void
    {
        $_SESSION['_flash_data'][$key] = $value;
    }

    public static function getFlashData($key)
    {
        $value = $_SESSION['_flash_data'][$key] ?? null;
        unset($_SESSION['_flash_data'][$key]);
        return $value;
    }


}