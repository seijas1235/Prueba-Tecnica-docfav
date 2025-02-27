<?php

namespace Tests\Unit\Entity;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User(
            new UserId('uuid-123'),
            new Name('John Doe'),
            new Email('john.doe@example.com'),
            new Password('SecurePass123!')
        );

        $this->assertEquals('uuid-123', $user->id()->value());
        $this->assertEquals('John Doe', $user->name()->value());
        $this->assertEquals('john.doe@example.com', $user->email()->value());
    }
}