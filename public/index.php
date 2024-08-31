<?php

define('ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR);
define('APP', ROOT.'App'.DIRECTORY_SEPARATOR);
define('VIEWS', APP.'Views'.DIRECTORY_SEPARATOR);
define('PUBLIC_FOLDER', 'public');
define('PUBLIC_FOLDER_PATH', ROOT.PUBLIC_FOLDER.DIRECTORY_SEPARATOR);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();
Router::loadRoutes();
Router::resolve();
