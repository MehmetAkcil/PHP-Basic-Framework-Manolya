<?php

namespace Core\Config;

class Config
{

    public static string $base_url = 'http://paketsatisold/';
    const SMTP_HOST = 'smtp.example.com';
    const SMTP_USERNAME = 'name@example.com';
    const SMTP_PASSWORD = '';
    const SMTP_PORT = 465;
    const SMTP_MAILER = 'Mailer';

    public static bool $origin = true;
    public static array $databases = [
        'default' => [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'gorevyap_react'
        ],
        'gorevyap' => [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'gorevyap'
        ]
    ];

    public static function base_url($url = ''): string
    {
        $baseurl = Config::$base_url;
        if($url === '/'){
            return $baseurl;
        }

        $end = substr($baseurl, -1, 1);
        if($end != '/'){
            $baseurl .= '/';
        }

        $end = substr($url, 0, 1);

        if($end == '/'){
            $url = ltrim($url, '/');
        }

        return $baseurl . $url;
    }

    public static function current_url(): string
    {

        return self::base_url(Header::getServer('REQUEST_URI'));
    }
}