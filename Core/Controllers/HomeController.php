<?php
namespace Core\Controllers;


use Core\Config\FormValidator;
use Exception;

class HomeController extends RootController
{

    /**
     * @throws Exception
     */
    public function index(): null
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