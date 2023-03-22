<?php
namespace Core\Controllers;

class HomeController extends RootController
{


    public function index()
    {
        echo $this->twigView('index', ['test' => 'abc']);
    }
}