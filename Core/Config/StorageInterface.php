<?php

namespace Core\Config;

interface StorageInterface
{
    public function get($key);

    public function set($key, $value, $expiration = null);

    public function remove($key);

    public function expire($key, $expiration);
}