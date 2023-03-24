<?php

namespace Core\Middlewares;

use Core\Config\Respond;
use Core\Config\Session;

class AuthMiddleware
{

    public function index()
    {
        //Session::set('auth', 'wergergre');
        if (! Session::has('auth')) {

            echo Respond::responseAuth([
                'message' => 'Auth invalid'
            ]);
            exit();
        }
    }

}