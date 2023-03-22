<?php

namespace Config;

class Config
{

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


    public static bool $origin = true;

    public static string $base_url = 'http://paketsatisold/';
}