<?php

namespace Core\Config;

class PasswordHash {

    private static mixed $cost = 10;

    public static function hash($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => self::$cost]);
    }

    public function verify($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}