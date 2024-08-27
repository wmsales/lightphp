<?php

namespace Core;

require '../vendor/autoload.php';

use Medoo\Medoo;
use Dotenv\Dotenv;

class Database
{
    private $database;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Config base de datos
        $this->database = new Medoo([
            'type' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS']
        ]);
    }

    // Obtener la instancia de la db para poder hacer consultas
    public function getORM(): Medoo
    {
        return $this->database;
    }
}

// Como usarlo:
// $db = new Database();
// $result = $db->getORM()->select('roles', ['nombre', 'descripcion']);

// print_r($result);