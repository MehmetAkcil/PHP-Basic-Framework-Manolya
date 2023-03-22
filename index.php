<?php
//rest api origin allow
use Config\Config;
use Config\Session;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Check PHP version.
$minPhpVersion = '8.2';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Php surumunuz %s ve uzeri olmasi gerekmektedir. Mevcut Surum: %s',
        $minPhpVersion,
        PHP_VERSION
    );

    exit($message);
}

//routers require
require_once 'Config/Session.php';

Session::start();

require_once 'autoload.php';

$origin = Config::$origin;

if($origin){
    \Config\Header::set('Access-Control-Allow-Origin', '*');
}
