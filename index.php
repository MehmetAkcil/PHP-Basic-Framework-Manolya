<?php
ob_start();
session_save_path('Temp/Sessions');
ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

include 'Core/Config/ErrorHandler.php';
$errorHandler = new \Core\Config\ErrorHandler();

set_exception_handler([$errorHandler, 'exceptionHandler']);
set_error_handler([$errorHandler, 'errorHandler']);

// Check PHP version.
$minPhpVersion = '8.1';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    exit('Your PHP version needs to be '.$minPhpVersion.' or higher. Current version is '.PHP_VERSION);
}

require_once 'autoload.php';

ob_end_flush();