<?php

namespace Tests\Unit\UseCase;

use App\Application\DTO\RegisterUserRequest;
use App\Application\UseCase\RegisterUserUseCase;
use App\Domain\Exception\UserAlreadyExistsException;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Entity\User; // Añadimos esta importación
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    public function testSuccessfulRegistration(): void
    {
        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository->method('findByEmail')->willReturn(null);

        $useCase = new RegisterUserUseCase($repository);
        $request = new RegisterUserRequest('uuid-123', 'Gustavo', 'gustavo@ejemplo.com', 'Contrasena123!');
        $response = $useCase->execute($request);

        $this->assertEquals('uuid-123', $response->id);
        $this->assertEquals('Gustavo', $response->name);
        $this->assertEquals('gustavo@ejemplo.com', $response->email);
    }

    public function testUserAlreadyExistsThrowsException(): void
    {
        $repository = $this->createMock(UserRepositoryInterface::class);
        // Cambiamos stdClass por una instancia real de User
        $existingUser = new User(
            new UserId('uuid-999'),
            new Name('otro usuario'),
            new Email('gustavo@ejemplo.com'),
            new Password('Contrasena123!')
        );
        $repository->method('findByEmail')->willReturn($existingUser);

        $useCase = new RegisterUserUseCase($repository);
        $request = new RegisterUserRequest('uuid-123', 'Gustavo', 'gustavo@ejemplo.com', 'Contrasena123!');

        $this->expectException(UserAlreadyExistsException::class);
        $useCase->execute($request);
    }
}