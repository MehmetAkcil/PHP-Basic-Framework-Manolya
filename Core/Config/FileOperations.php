<?php
namespace Core\Config;

class FileOperations {

    private $fileName;

    function __construct($fileName) {
        $this->fileName = $fileName;
    }

    function readFile(): false|string
    {
        $file = fopen($this->fileName, "r");
        $content = fread($file, filesize($this->fileName));
        fclose($file);
        return $content;
    }

    function writeFile($content): void
    {
        $file = fopen($this->fileName, "w");
        fwrite($file, $content);
        fclose($file);
    }

    function deleteFile(): void
    {
        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }

    function fileExists(): bool
    {
        return file_exists($this->fileName);
    }
}