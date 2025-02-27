<?php

namespace Tests\Unit\ValueObject;

use App\Domain\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testValidUserId(): void
    {
        $id = new UserId('uuid-123');
        $this->assertEquals('uuid-123', $id->value());
    }

    public function testEmptyUserIdThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new UserId('');
    }
}