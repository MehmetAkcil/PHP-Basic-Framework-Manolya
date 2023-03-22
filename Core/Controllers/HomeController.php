<?php
namespace Core\Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\TwigFunction;

class HomeController extends RootController
{

    protected function twigView($tpl, $data = [])
    {

        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . '/Core/Views');
        $twig = new \Twig\Environment($loader, [
            //'cache' => WRITEPATH . '/cache/twig',
        ]);

        $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Europe/Istanbul');

        $twig->addFunction(new TwigFunction('print', function ($asset) {
            return print_r($asset);
        }));

        $tpl = !stripos($tpl, '.twig') ? $tpl . '.twig' : $tpl;

        return $twig->render($tpl, $data);
    }

    public function index()
    {
        echo $this->twigView('index', []);
    }
}