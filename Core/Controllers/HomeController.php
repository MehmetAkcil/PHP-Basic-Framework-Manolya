<?php
namespace Core\Controllers;


use Core\Config\DotEnv;
use Core\Config\HelperLoader;
use Exception;

class HomeController extends RootController
{

    /**
     * @throws Exception
     */
    public function index(): void
    {

//        echo env('isim');
//        echo ini_service('google-ads', 'client', 'id');
//        HelperLoader::load('test');
//        echo name('rgerg');


    }

    public function test(): string
    {
        return 'test';
    }
}