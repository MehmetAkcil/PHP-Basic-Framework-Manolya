<?php


use Core\Config\DotEnv;


function env($key)
{
    $env = new DotEnv();
    return $env->get($key);
}