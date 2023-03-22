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
        Session::set(Config::csrfTokenNameSession, $this->token);
    }

    public function getToken(): string
    {
        return Session::has(Config::csrfTokenNameSession) ? Session::get(Config::csrfTokenNameSession) : $this->token;
    }

    public function verifyToken($token): bool
    {

        if (Session::has(Config::csrfTokenNameSession) && Session::get(Config::csrfTokenNameSession) === $token) {
            Session::delete(Config::csrfTokenNameSession);
            return true;
        }
        return false;
    }

    public function addTokenToForm(): string
    {
        return sprintf(
            '<input type="hidden" name="%s" value="%s">',
            Config::csrfTokenName,
            $this->getToken()
        );
    }
}