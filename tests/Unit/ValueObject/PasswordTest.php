<?php

namespace Tests\Unit\ValueObject;

use App\Domain\ValueObject\Password;
use App\Domain\Exception\WeakPasswordException;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testValidPassword(): void
    {
        $password = new Password('Contrasena123!');
        $this->assertTrue($password->verify('Contrasena123!'));
    }

    public function testWeakPasswordThrowsException(): void
    {
        $this->expectException(WeakPasswordException::class);
        $this->expectExceptionMessage('La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, un número y un carácter especial');
        new Password('weak');
    }
}