<?php


use Config\Email;
use Controllers\RootController;
use Libraries\sendMail;

class HomeController extends RootController
{
    public function index()
    {
        $email = new Email('Mehmet Dev', 'mehmetakcil.dev@gmail.com', 'test','test body');
        return $email->send();
    }
}