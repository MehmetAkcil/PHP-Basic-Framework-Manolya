<?php
namespace Core\Controllers;


class HomeController extends RootController
{

    public function index(): string
    {

        return self::view('index');
    }

    public function test(): string
    {
        return 'test';
    }
}