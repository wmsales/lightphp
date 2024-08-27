<?php

namespace Core;

require '../vendor/autoload.php';

use Medoo\Medoo;
use Dotenv\Dotenv;

class Database
{
    private $database;
    private $cache;

    public function __construct()
    {
        $this->cache = new Cache(); // crear cache

        $config = $this->cache->get('db_config');

        if (!$config) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            // Config base de datos
            $config = [
                'type' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
            ];

            // guardar en cache
            $this->cache->set('db_config', $config);
        }

        $this->database = new Medoo($config);
    }

    public function getORM(): Medoo
    {
        return $this->database;
    }
}

// Ejemplo de uso:
// $db = new Database();
// $result = $db->getORM()->select('roles', ['nombre', 'descripcion']);
// print_r($result);
