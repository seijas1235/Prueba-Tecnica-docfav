<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once "vendor/autoload.php";

$paths = [__DIR__ . '/src/Domain/Entity'];
$isDevMode = true;

$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => '172.27.192.1', 
    'port' => '3307',
    'user' => 'root', 
    'password' => 'sebas', 
    'dbname' => 'user_registration',
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);