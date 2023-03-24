<?php
use Core\Config\Config;
use Core\Config\IpRestrictor;
use Core\Config\RateLimiter;


spl_autoload_register(function ($class) {
    // namespace'leri ve dosya yollarını belirleyin
    $namespaces = array(
        'Core\Controllers' => 'Core/Controllers/',
        'Core\Config' => 'Core/Config/',
        'Core\Models' => 'Core/Models/',
        'Core\Libraries' => 'Core/Libraries/',
        'Core\Middlewares' => 'Core/Middlewares/',
    );

    // Sınıfı arayın ve yükleyin
    foreach ($namespaces as $namespace => $dir) {
        if (str_starts_with($class, $namespace . '\\')) {
            $class_path = str_replace('\\', '/', substr($class, strlen($namespace) + 1)) . '.php';
            $file = $dir . $class_path;
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});
\Core\Config\Session::start();

require 'vendor/autoload.php';

if(Config::$origin){
    \Core\Config\Header::set('Access-Control-Allow-Origin', '*');
}

if(Config::RATE_LIMITER_STATUS){
    $ipLimit = new RateLimiter();
    $ipLimit->checkRequestCount();
}

if(Config::IP_RESTRICTOR_STATUS){
    $restrictor = new IpRestrictor(Config::IP_RESTRICTOR_ALLOWED);
    $restrictor->restrict();
}


require_once __DIR__ . '/Routes.php';
