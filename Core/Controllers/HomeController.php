<?php
namespace Core\Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends RootController
{


    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function index(): string
    {

        return self::view('index');
    }

    public function test(): string
    {
        return 'test';
    }
    public function test2(): string
    {
        return 'test2';
    }
    public function test3(): string
    {
        return 'test3';
    }
    public function test4(): string
    {
        return 'test4';
    }
}