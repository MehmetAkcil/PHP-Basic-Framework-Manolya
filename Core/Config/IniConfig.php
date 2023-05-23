<?php

namespace Core\Config;


class IniConfig
{
    protected array $configData = [];

    public function __construct($fileName = 'config')
    {
        $basePath = realpath(__DIR__ . '/../../');
        $filePath = $basePath . '/' .  $fileName . '.ini';
        $this->loadIniFile($filePath);
    }

    protected function loadIniFile($filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("IniConfig: Dosya bulunamadı: $filePath");
        }

        $this->configData = parse_ini_file($filePath, true);
    }

    public function get($section, $key, $default = null)
    {
        if (isset($this->configData[$section][$key])) {
            return $this->configData[$section][$key];
        }

        return $default;
    }

    public function getSection($section)
    {
        return $this->configData[$section] ?? [];
    }
}
