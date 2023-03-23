<?php
namespace Core\Config;

class FileStorage implements StorageInterface
{
    private mixed $directory;
    private string $mime;

    public function __construct($directory, $mime = '.dat')
    {
        $this->mime = $mime;
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
        return $this->directory . '/' . md5($key) . $this->mime;
    }
}