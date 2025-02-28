<?php

require_once 'vendor/autoload.php';

use App\Application\UseCase\RegisterUserUseCase;
use App\Infrastructure\Controller\RegisterUserController;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Infrastructure\Event\WelcomeEmailListener;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [__DIR__ . '/src/Domain/Entity'];
$isDevMode = true;
$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => 'db',
    'port' => '3306',
    'user' => 'root',
    'password' => 'sebas',
    'dbname' => 'user_registration',
];


$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);

$repository = new DoctrineUserRepository($entityManager);
$useCase = new RegisterUserUseCase($repository, [new WelcomeEmailListener()]);
$controller = new RegisterUserController($useCase);

$data = [
    'id' => 'uuid-123',
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'password' => 'SecurePass123!'
];

header('Content-Type: application/json');
echo $controller->register($data);