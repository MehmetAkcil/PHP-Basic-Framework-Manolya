<?php
namespace Core\Controllers;


use Exception;

class HomeController extends RootController
{

    /**
     * @throws Exception
     */
    public function index()
    {

        return self::view('auth/index', [
            'title' => 'test'
        ]);
    }

    public function test(): string
    {
        return 'test';
    }
}