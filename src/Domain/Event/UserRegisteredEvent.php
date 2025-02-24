<?php

namespace App\Domain\Event;

use App\Domain\Entity\User;

class UserRegisteredEvent
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user(): User
    {
        return $this->user;
    }
}