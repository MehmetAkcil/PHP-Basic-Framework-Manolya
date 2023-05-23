<?php
namespace Core\Controllers;


use Core\Config\DotEnv;
use Exception;

class HomeController extends RootController
{

    /**
     * @throws Exception
     */
    public function index(): void
    {

        echo env('isim');
    }

    public function test(): string
    {
        return 'test';
    }
}