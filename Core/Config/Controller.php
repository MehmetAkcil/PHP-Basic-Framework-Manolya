<?php
namespace Core\Config;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\CoreExtension;
use Twig\TwigFunction;

class Controller
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    protected function twigView($tpl, $data = []): string
    {

        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . '/Core/Views');
        $twig = new \Twig\Environment($loader);

        $twig->getExtension(CoreExtension::class)->setTimezone('Europe/Istanbul');

        $twig->addFunction(new TwigFunction('print', function ($asset) {
            return print_r($asset, true);
        }));

        $tpl = !stripos($tpl, '.twig') ? $tpl . '.twig' : $tpl;

        return $twig->render($tpl, $data);
    }


    public function assets($assets): false|int|string
    {
        if(stristr($assets, '&')){
            $assets = str_replace('&', '/', $assets);
        }
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/Public/Assets/' . $assets;
        if(! file_exists($filename)){
            return 'File Not Found.';
        }
        return self::typer($filename);
    }

    public function upload($document): false|int|string
    {
        if(stristr($document, '&')){
            $document = str_replace('&', '/', $document);
        }
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/Public/Uploads/' . $document;
        if(! file_exists($filename)){
            return 'File Not Found.';
        }
        return self::typer($filename);
    }

    private static function typer($filename): false|int
    {
        $fInfo = finfo_open(FILEINFO_MIME_TYPE);
        $contentType = finfo_file($fInfo, $filename);

        Header::set('Content-Type', $contentType);
        $response = readfile($filename);

        finfo_close($fInfo);
        return $response;
    }
}