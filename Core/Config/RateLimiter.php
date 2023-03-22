<?php

namespace Core\Config;

class RateLimiter
{
    private mixed $ip;
    private mixed $maxRequestsPerMinute;
    private mixed $storage;

    public function __construct($storage = null)
    {
        $this->ip = Header::getServer('REMOTE_ADDR');
        $this->maxRequestsPerMinute = Config::RATE_LIMITER_MAX_REQUESTS_PER_MINUTE;
        $this->storage = $storage ?: new FileStorage(Config::path_rate_limiter());
    }

    private function getKey(): string
    {
        return 'ip_restriction_' . $this->ip;
    }

    public function checkRequestCount(): void
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







