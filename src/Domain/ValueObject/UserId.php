<?php

namespace App\Domain\ValueObject;

class UserId
{
    private string $id;

    public function __construct(string $id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('User ID cannot be empty');
        }
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}