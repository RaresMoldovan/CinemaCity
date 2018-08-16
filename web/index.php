<?php

require_once '../vendor/autoload.php';

use Router\Router;
use Model\DataAccess\Connection\DatabaseConfiguration;
use Model\DataAccess\Connection\DatabaseConnection;

error_reporting(0);
ini_set('display_errors', 0);

$session = new \Router\Protocol\Session();
$session->startSession();
$dbConfig = require_once '../src/Model/DataAccess/config.php';

$configuration = new DatabaseConfiguration(
    $dbConfig['host'],
    $dbConfig['databaseName'],
    $dbConfig['username'],
    $dbConfig['password']
);
$connection    = new DatabaseConnection($configuration);

$router   = new Router($connection);
$response = $router->route();
$response->render();
