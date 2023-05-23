<?php

namespace Core\Config;

class DotEnv
{
    protected array $envData = [];

    public function __construct($filePath = null)
    {
        if ($filePath === null) {
            $filePath = $this->getDefaultEnvFilePath();
        }
        $this->loadEnvFile($filePath);
    }


    protected function loadEnvFile($filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("DotEnv: Dosya bulunamadı: $filePath");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if ($this->isComment($line)) {
                continue;
            }

            list($key, $value) = $this->parseLine($line);
            $this->envData[$key] = $value;
        }
    }

    protected function isComment($line): bool
    {
        return str_starts_with(trim($line), '#');
    }

    protected function parseLine($line): array
    {
        list($key, $value) = array_map('trim', explode('=', $line, 2));
        $value = $this->processValue($value);
        return [$key, $value];
    }

    protected function processValue($value)
    {
        if ($value === 'true') {
            return true;
        } elseif ($value === 'false') {
            return false;
        } elseif ($value === 'null') {
            return null;
        } elseif ($value[0] === '"' && $value[strlen($value) - 1] === '"') {
            return substr($value, 1, -1);
        } elseif (is_numeric($value)) {
            return $value + 0;
        }

        return $value;
    }

    public function get($key, $default = null)
    {
        return $this->envData[$key] ?? $default;
    }

    protected function getDefaultEnvFilePath(): string
    {
        $basePath = realpath(__DIR__ . '/../../');

        return $basePath . '/.env';
    }

}
