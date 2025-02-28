<?php

namespace Tests\Integration;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

class DoctrineUserRepositoryTest extends TestCase
{
    private EntityManager $entityManager;
    private DoctrineUserRepository $repository;

    protected function setUp(): void
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../../src/Domain/Entity'],
            true,
            null,
            null,
            false
        );
        $dbParams = [
            'driver' => 'pdo_mysql',
            'host' => 'db',
            'port' => '3306',
            'user' => 'root',
            'password' => 'sebas',
            'dbname' => 'user_registration',
        ];
        $this->entityManager = EntityManager::create($dbParams, $config);
        $this->repository = new DoctrineUserRepository($this->entityManager);

        // Actualizar el esquema en lugar de crearlo desde cero
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
        $schemaTool->updateSchema([$this->entityManager->getClassMetadata(User::class)], true); // true para preservar datos existentes
    }

    public function testSaveAndFindUser(): void
    {
        $user = new User(
            new UserId('uuid-123'),
            new Name('Gustavo'),
            new Email('gustavo@ejemplo.com'),
            new Password('Contrasena123!')
        );

        $this->repository->save($user);
        $foundUser = $this->repository->findById(new UserId('uuid-123'));

        $this->assertNotNull($foundUser);
        $this->assertEquals('uuid-123', $foundUser->id()->value());
    }
}