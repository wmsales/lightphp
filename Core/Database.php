<?php

use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'nombre_de_tu_base_de_datos',
    'username' => 'tu_usuario',
    'password' => 'tu_contraseña'
]);

return $database;



?>