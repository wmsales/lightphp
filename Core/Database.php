<?php

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
            'type' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS']
        ]);
    }

    // Obtener la instancia de la db para poder hacer consultas
    public function getDbConn(): Medoo
    {
        return $this->database;
    }
}
