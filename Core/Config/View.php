<?php

namespace Core\Config;


use Exception;

class View
{

    private string $fileName;

    private mixed $dataList;


    public function __construct($filename, $dataList = [])
    {
        $this->fileName = $filename;
        $this->dataList = $dataList;
    }

    /**
     * @throws Exception
     */
    public function renderer(): void
    {
        $path = Config::path_views($this->fileName . '.php');

        if (file_exists($path)) {
            extract($this->dataList);
            include $path;
        } else {
            throw new Exception('Template file not found: ' . $this->fileName);
        }
    }

}