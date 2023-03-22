<?php
namespace Controllers;

use Config\Email;
use Controllers\RootController;
use Libraries\sendMail;

class HomeController extends RootController
{
    public function index()
    {
        return 'Merhaba';
    }
}