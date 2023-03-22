<?php

namespace Core\Config;

class IpRestrictor
{
    private array $allowed_ips;

    public function __construct(array $allowed_ips)
    {
        $this->allowed_ips = $allowed_ips;
    }

    public function isAllowed($ip): bool
    {
        return in_array($ip, $this->allowed_ips);
    }

    public function restrict(): void
    {
        $ip = Header::getServer('REMOTE_ADDR');

        if (!$this->isAllowed($ip)) {
            http_response_code(403);
            die('Access denied');
        }
    }
}

