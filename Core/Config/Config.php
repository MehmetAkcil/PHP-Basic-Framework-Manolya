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
}