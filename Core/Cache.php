<?php

namespace Core;

class Cache
{
    private $cacheDir;

    public function __construct($cacheDir = __DIR__ . '/../var/cache/')
    {
        $this->cacheDir = $cacheDir;
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
    }

    public function get($key)
    {
        $cacheFile = $this->cacheDir . $this->generateCacheFilename($key);
        if (file_exists($cacheFile)) {
            return include $cacheFile;
        }
        return null;
    }

    public function set($key, $data)
    {
        $cacheFile = $this->cacheDir . $this->generateCacheFilename($key);
        $content = '<?php return ' . var_export($data, true) . ';';
        file_put_contents($cacheFile, $content);
    }

    public function clear($key = null)
    {
        if ($key) {
            $cacheFile = $this->cacheDir . $this->generateCacheFilename($key);
            if (file_exists($cacheFile)) {
                unlink($cacheFile);
            }
        } else {
            $files = glob($this->cacheDir . '*.php');
            foreach ($files as $file) {
                unlink($file);
            }
        }
    }

    private function generateCacheFilename($key)
    {
        return md5($key) . '.cache.php';
    }
}
