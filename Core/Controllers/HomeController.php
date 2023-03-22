<?php
namespace Core\Controllers;

use Core\Config\Config;
use Core\Config\Request;
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
        return $this->twigView('index', ['test' => 'abc']);
    }

    public function test(): string
    {
        return 'test';
    }
}