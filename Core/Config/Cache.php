<?php

namespace Core\Config;

use Exception;

class Cache {

    private mixed $cache_dir;

    public function __construct($cache_dir = null) {
        $this->cache_dir = $cache_dir ?: Config::path_cache();

        if (!file_exists($this->cache_dir)) {
            throw new Exception("Cache directory does not exist.");
        }
    }

    public function set($key, $value, $expiration = 3600): bool
    {
        $file = $this->getCacheFilename($key);

        if (!$file) {
            return false;
        }

        $data = array(
            'expiration' => time() + $expiration,
            'data' => $value
        );

        $result = file_put_contents($file, serialize($data));

        return $result !== false;
    }

    public function get($key) {
        $file = $this->getCacheFilename($key);

        if (!$file || !file_exists($file)) {
            return false;
        }

        $data = unserialize(file_get_contents($file));

        if ($data['expiration'] < time()) {
            unlink($file);
            return false;
        }

        return $data['data'];
    }

    private function getCacheFilename($key): string
    {
        $hash = md5($key);
        return $this->cache_dir . $hash . '.cache';
    }
}