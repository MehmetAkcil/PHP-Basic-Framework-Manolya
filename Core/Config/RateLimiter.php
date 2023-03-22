<?php

namespace Core\Config;

class RateLimiter
{
    private $ip;
    private $maxRequestsPerMinute;
    private $storage;

    public function __construct($maxRequestsPerMinute = 10, $storage = null)
    {
        $this->ip = Header::getServer('REMOTE_ADDR');
        $this->maxRequestsPerMinute = $maxRequestsPerMinute;
        $this->storage = $storage ?: new FileStorage(Config::path_rate_limiter());
    }

    private function getKey(): string
    {
        return 'ip_restriction_' . $this->ip;
    }

    public function checkRequestCount()
    {
        $key = $this->getKey();

        // Get the current request count
        $requestCount = $this->storage->get($key) ?: 0;

        // Increment the request count
        $this->storage->set($key, ++$requestCount);

        // Check if the request count has exceeded the limit
        if ($requestCount > $this->maxRequestsPerMinute) {
            $this->storage->expire($key, Config::RATE_LIMITER_EXPIRATION); // Set expiration time of key to 1 minute
            header('HTTP/1.1 429 Too Many Requests');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(['error' => 'Too many requests.']);
            exit;
        }

        // Schedule the key to expire after one minute
        $this->storage->expire($key, Config::RATE_LIMITER_EXPIRATION);
    }

    public function clearRequestCount(): void
    {
        $this->storage->remove($this->getKey());
    }
}

interface StorageInterface
{
    public function get($key);

    public function set($key, $value, $expiration = null);

    public function remove($key);

    public function expire($key, $expiration);
}

class FileStorage implements StorageInterface
{
    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function get($key)
    {
        $file = $this->getFile($key);
        if (!file_exists($file)) {
            return null;
        }
        $data = unserialize(file_get_contents($file));
        if (time() >= $data['expiration']) {
            $this->remove($key);
            return null;
        }
        return $data['value'];
    }

    public function set($key, $value, $expiration = null)
    {
        $data = [
            'value' => $value,
            'expiration' => time() + ($expiration ?: 0),
        ];
        file_put_contents($this->getFile($key), serialize($data));
    }

    public function remove($key)
    {
        $file = $this->getFile($key);
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function expire($key, $expiration)
    {
        $file = $this->getFile($key);
        if (file_exists($file)) {
            $data = unserialize(file_get_contents($file));
            $data['expiration'] = time() + ($expiration ?: 0);
            file_put_contents($file, serialize($data));
        }
    }

    private function getFile($key): string
    {
        return $this->directory . '/' . md5($key) . '.dat';
    }
}






