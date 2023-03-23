<?php

namespace Core\Config;

use Exception;

class CsrfToken
{
    private string $token;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->token = bin2hex(random_bytes(32));
        Session::set(Config::CSRF_TOKEN_NAME_SESSION, $this->token);
    }

    public function getToken(): string
    {
        return Session::has(Config::CSRF_TOKEN_NAME_SESSION) ? Session::get(Config::CSRF_TOKEN_NAME_SESSION) : $this->token;
    }

    public function verifyToken($token): bool
    {

        if (Session::has(Config::CSRF_TOKEN_NAME_SESSION) && Session::get(Config::CSRF_TOKEN_NAME_SESSION) === $token) {
            Session::delete(Config::CSRF_TOKEN_NAME_SESSION);
            return true;
        }
        return false;
    }

    public function addTokenToForm(): string
    {
        return sprintf(
            '<input type="hidden" name="%s" value="%s">',
            Config::CSRF_TOKEN_NAME,
            $this->getToken()
        );
    }
}