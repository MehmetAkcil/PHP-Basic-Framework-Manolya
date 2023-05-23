<?php
namespace Core\Config;

class HelperLoader
{
    protected static array $helpers = [
        'system' => 'system',
    ];

    public static function loadHelpers(): void
    {
        foreach (self::$helpers as $fileName => $className) {
            $filePath = __DIR__ . '/../Helpers/' . $fileName . '.php';

            if (file_exists($filePath)) {
                require_once $filePath;
            } else {
                throw new \RuntimeException("HelperLoader: Dosya bulunamadı: $filePath");
            }

        }
    }

    public static function load($fileName): void
    {
        $filePath = __DIR__ . '/../Helpers/' . $fileName . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            throw new \RuntimeException("HelperLoader: Dosya bulunamadı: $filePath");
        }
    }

}
