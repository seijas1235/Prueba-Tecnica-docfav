<?php

namespace App\Application\UseCase;

use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Exception\UserAlreadyExistsException;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private array $eventListeners;

    // Inyecta dependencias para desacoplar persistencia y eventos
    public function __construct(UserRepositoryInterface $userRepository, array $eventListeners = [])
    {
        $this->userRepository = $userRepository;
        $this->eventListeners = $eventListeners;
    }

    // Registra un usuario y dispara evento de dominio
    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $email = new Email($request->email);
        if ($this->userRepository->findByEmail($email->value())) {
            throw new UserAlreadyExistsException('User with this email already exists');
        }

        $user = new User(
            new UserId($request->id),
            new Name($request->name),
            $email,
            new Password($request->password)
        );

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($user);
        $this->dispatchEvent($event);

        return new UserResponseDTO(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $user->createdAt()->format('Y-m-d H:i:s')
        );
    }

    private function dispatchEvent(UserRegisteredEvent $event): void
    {
        foreach ($this->eventListeners as $listener) {
            $listener($event);
        }
    }
}