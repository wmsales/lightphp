<?php

require 'vendor/autoload.php';

use Core\Bootstrap;

$bootstrap = new Bootstrap(); // Necesario para jalar config de cache
$config = $bootstrap->getConfig()['db'];

return [
    'migration_dirs' => [
        'default' => __DIR__ . '/db/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => $config['driver'],
            'host' => $config['host'],
            'port' => $config['port'],
            'username' => $config['username'],
            'password' => $config['password'],
            'db_name' => $config['database'],
            'charset' => $config['charset'],
            'collation' => $config['collation'],
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];
