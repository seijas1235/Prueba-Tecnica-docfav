<?php

namespace App\Application\DTO;

class RegisterUserRequest
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}