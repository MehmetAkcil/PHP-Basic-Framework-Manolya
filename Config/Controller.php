<?php
namespace Config;

class Controller
{

    public static function base_url($url): string
    {
        $baseurl = Config::$base_url;
        if(stristr($baseurl, '/')){
            return $baseurl . $url;
        }
        return $baseurl . '/' . $url;
    }

    public function assets($assets): false|int|string
    {
        if(stristr($assets, '&')){
            $assets = str_replace('&', '/', $assets);
        }
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/Public/Assets/' . $assets;
        if(! file_exists($filename)){
            return 'Dosya bulunamadi.';
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
            return 'Dosya bulunamadi.';
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