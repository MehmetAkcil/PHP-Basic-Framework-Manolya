<?php
namespace Core\Config;


use Exception;

class Controller
{

    /**
     * @throws Exception
     */
    protected static function view($tpl, $data = [])
    {
        $view = new View($tpl, $data);

        return $view->renderer();
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