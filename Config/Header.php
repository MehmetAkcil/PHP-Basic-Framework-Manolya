<?php

class Header
{
    private array $headers = [];

    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    public function getAccept(): ?string
    {
        return $this->headers['Accept'] ?? null;
    }

    public function getAcceptCharset(): ?string
    {
        return $this->headers['Accept-Charset'] ?? null;
    }

    public function getAcceptEncoding(): ?string
    {
        return $this->headers['Accept-Encoding'] ?? null;
    }

    public function getAcceptLanguage(): ?string
    {
        return $this->headers['Accept-Language'] ?? null;
    }

    public function getAuthorization(): ?string
    {
        return $this->headers['Authorization'] ?? null;
    }

    public function getConnection(): ?string
    {
        return $this->headers['Connection'] ?? null;
    }

    public function getContentLength(): ?int
    {
        return $this->headers['Content-Length'] ?? null;
    }

    public function getContentType(): ?string
    {
        return $this->headers['Content-Type'] ?? null;
    }

    public function getCookie(): ?string
    {
        return $this->headers['Cookie'] ?? null;
    }

    public function getHost(): ?string
    {
        return $this->headers['Host'] ?? null;
    }

    public function getReferer(): ?string
    {
        return $this->headers['Referer'] ?? null;
    }

    public function getUserAgent(): ?string
    {
        return $this->headers['User-Agent'] ?? null;
    }

    public function get(string $header): ?string
    {
        return $this->headers[$header] ?? null;
    }
}