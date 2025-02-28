<?php

namespace Tests\Unit\ValueObject;

use App\Domain\ValueObject\Email;
use App\Domain\Exception\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmail(): void
    {
        $email = new Email('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $email->value());
    }

    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(InvalidEmailException::class);
        new Email('invalid-email');
    }
}