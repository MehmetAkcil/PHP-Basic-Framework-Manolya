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

//$allowed_ips = array('127.0.0.1', '192.168.1.1');
//$restrictor = new IpRestrictor($allowed_ips);
//$restrictor->restrict();