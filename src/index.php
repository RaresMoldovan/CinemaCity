<?php

require_once '../vendor/autoload.php';
use Router\Router;
use Model\DataAccess\Connection\DatabaseConfiguration;
use Model\DataAccess\Connection\DatabaseConnection;

$dbConfig = require_once 'Model/DataAccess/config.php';

$configuration =  new DatabaseConfiguration($dbConfig['host'],
                                            $dbConfig['databaseName'],
                                            $dbConfig['username'],
                                            $dbConfig['password']);
$connection = new DatabaseConnection($configuration);
$router = new Router($connection);
echo $router->route();