<?php


use Controllers\RootController;
use Libraries\sendMail;

class HomeController extends RootController
{
    public function index()
    {
        $sendMail = new sendMail();
        return $sendMail->send();
    }
}