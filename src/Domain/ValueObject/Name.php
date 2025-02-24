<?php

namespace App\Domain\ValueObject;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        if (strlen($name) < 3 || !preg_match('/^[a-zA-Z\s]+$/', $name)) {
            throw new \InvalidArgumentException('Name must be at least 3 characters and contain only letters and spaces');
        }
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}