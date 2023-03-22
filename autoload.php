<?php
spl_autoload_register(function ($class) {
    // namespace'leri ve dosya yollarını belirleyin
    $namespaces = array(
        'Controllers' => __DIR__ . '/Controllers/',
        'Config' => __DIR__ . '/Config/',
        'Models' => __DIR__ . '/Models/',
        'Libraries' => __DIR__ . '/Libraries/',
    );

    // Sınıfı arayın ve yükleyin
    foreach ($namespaces as $namespace => $dir) {
        if (strpos($class, $namespace . '\\') === 0) {
            $class_path = str_replace('\\', '/', substr($class, strlen($namespace) + 1)) . '.php';
            $file = $dir . $class_path;
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});
require_once __DIR__ . '/Routes.php';