<?php
ob_start();
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Check PHP version.
$minPhpVersion = '8.2';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    exit('Your PHP version needs to be '.$minPhpVersion.' or higher. Current version is '.PHP_VERSION);
}

require_once 'autoload.php';

ob_end_flush();