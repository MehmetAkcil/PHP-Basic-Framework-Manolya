<?php

namespace Core\Config;

use AllowDynamicProperties;
use Exception;

#[AllowDynamicProperties] class CurlRequest
{
    private false|\CurlHandle $ch;

    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);
    }

    public function get($url, $params = []): bool|string
    {
        $query = http_build_query($params);
        curl_setopt($this->ch, CURLOPT_URL, $url . '?' . $query);
        return $this->execute();
    }

    public function post($url, $params = []): bool|string
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        return $this->execute();
    }

    public function put($url, $params = []): bool|string
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        return $this->execute();
    }

    /**
     * @throws Exception
     */
    public function delete($url, $params = []): bool|string
    {
        $query = http_build_query($params);
        curl_setopt($this->ch, CURLOPT_URL, $url . '?' . $query);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        return $this->execute();
    }

    public function setOpt($name, $data): void
    {
        curl_setopt($this->ch, $name, $data);
    }

    /**
     * @throws Exception
     */
    private function execute()
    {
        $response = curl_exec($this->ch);
        if ($response === false) {
            throw new Exception(curl_error($this->ch));
        }
        return $response;
    }

    public function setCookieJar($filename): void
    {
        $this->cookieJar = $filename;
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookieJar);
    }

    public function getCookieJar() {
        return $this->cookieJar;
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}