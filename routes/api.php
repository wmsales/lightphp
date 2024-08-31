<?php

use Core\Router;

Router::get('/users', 'Api\UserController@getAllUsers');
Router::get('/users/{id}', 'Api\UserController@getUserById');
