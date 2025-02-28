<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidEmailException;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException('Invalid email format');
        }
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }

    public function equals(self $other): bool
    {
        return $this->email === $other->email;
    }
}