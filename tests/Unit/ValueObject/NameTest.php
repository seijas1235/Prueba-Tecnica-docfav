<?php

namespace Tests\Unit\ValueObject;

use App\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testValidName(): void
    {
        $name = new Name('John Doe');
        $this->assertEquals('John Doe', $name->value());
    }

    public function testShortNameThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('Jo');
    }

    public function testInvalidCharactersThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('John123');
    }
}