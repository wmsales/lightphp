<?php
    use Core\Router;

Router::get('/', 'Home@index');
Router::get('/example', 'Home@example');
Router::get('/example/{id}', 'Home@exampleWithArgs');
