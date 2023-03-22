<?php

use Config\Respond;
use Config\Session;

class AuthMiddleware
{

    public function index()
    {
        //Session::set('auth', 'wergergre');
        if(Session::get('auth') === null){

            Respond::responseAuth([
                'message' => 'Auth invalid'
            ]);
            exit();
        }
    }

}