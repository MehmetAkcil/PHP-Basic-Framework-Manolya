<?php
namespace Core\Controllers;


use Core\Config\FormValidator;
use Exception;

class HomeController extends RootController
{

    /**
     * @throws Exception
     */
    public function index()
    {
        return self::view('index', [
            'title' => 'test'
        ]);
    }

    public function test(): string
    {
        return 'test';
    }
}