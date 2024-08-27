<?php

namespace Core;

use Medoo\Medoo;

class Database
{
    private $database;
    private $config;

    public function __construct()
    {
        $bootstrap = new Bootstrap();
        $this->config = $bootstrap->getConfig()['db'];

        $this->database = new Medoo($this->config);
    }

    public function getORM(): Medoo
    {
        return $this->database;
    }
}
