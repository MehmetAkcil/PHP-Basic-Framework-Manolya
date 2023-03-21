<?php
//rest api origin allow
header("Access-Control-Allow-Origin: *");

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
require_once 'Config/Redirect.php';
require_once 'Config/Respond.php';
require_once 'Config/Database.php';
require_once 'Config/Router.php';