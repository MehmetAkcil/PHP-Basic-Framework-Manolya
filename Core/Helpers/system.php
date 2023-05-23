<?php


use Core\Config\Config;
use Core\Config\DotEnv;
use Core\Config\Header;
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

function base_url($url = ''): string
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

function current_url(): string
{

    return base_url(Header::getServer('REQUEST_URI'));
}
