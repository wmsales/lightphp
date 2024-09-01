<?php
    use Core\Router;

Router::get('/', 'Home@index');
Router::get('/home/example', 'Home@example');
Router::get('/home/example/{id}', 'Home@exampleWithArgs');

