<?php

namespace Core\Config;

use Core\Config\Header;

class Paths
{
    public static function path_rate_limiter(): string
    {
        return Header::getServer('DOCUMENT_ROOT') . '/Temp/RateLimiter/';
    }

    public static function path_cache(): string
    {
        return Header::getServer('DOCUMENT_ROOT') . '/Temp/Cache/';
    }

    public static function path_sessions(): string
    {
        return Header::getServer('DOCUMENT_ROOT') . '/Temp/Sessions/';
    }

    public static function path_uploads(): string
    {
        return Header::getServer('DOCUMENT_ROOT') . '/Temp/Uploads/';
    }

    public static function path_views($path = ''): string
    {
        return Header::getServer('DOCUMENT_ROOT') . '/Core/Views/' . $path;
    }
}