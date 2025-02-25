<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;

class RegisterUserController
{
    private RegisterUserUseCase $useCase;

    public function __construct(RegisterUserUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function register(array $data): string
    {
        $request = new RegisterUserRequest(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['password']
        );

        $response = $this->useCase->execute($request);
        return $response->toJson();
    }
}