<?php

namespace Core;

use Dotenv\Dotenv;

class Bootstrap
{
    private $cache;
    private $config;

    public function __construct()
    {
        $autoloadPath = dirname(__DIR__) . '/vendor/autoload.php';

        if (!file_exists($autoloadPath)) {
            throw new \Exception('Autoload file not found.');
        }

        require $autoloadPath;
        
        $this->cache = new Cache(); // crear el Cache
        $this->initializeConfig();
    }

    private function initializeConfig()
    {
        $this->config = $this->cache->get('app_config');

        if (!$this->config) {
            // Si no existe en cache, cargar la info del .env
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            // guardar config
            $this->config = [
                'db' => [
                    'driver' => $_ENV['DB_DRIVER'],
                    'host' => $_ENV['DB_HOST'],
                    'database' => $_ENV['DB_NAME'],
                    'username' => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASS'],
                    'port' => $_ENV['DB_PORT'],
                    'charset' => $_ENV['DB_CHARSET'],
                    'collation' => $_ENV['DB_COLLATION'],
                ]
            ];

            // guardar en cache
            $this->cache->set('app_config', $this->config);
        }
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
