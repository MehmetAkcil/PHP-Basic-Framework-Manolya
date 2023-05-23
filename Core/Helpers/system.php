<?php


use Core\Config\DotEnv;
use Core\Config\IniConfig;


function env($key)
{
    $env = new DotEnv();
    return $env->get($key);
}

function ini_service($serviceName, $parentName, $parentParentName)
{
    $config = new IniConfig($serviceName);
    return $config->get($parentName, $parentParentName);

}