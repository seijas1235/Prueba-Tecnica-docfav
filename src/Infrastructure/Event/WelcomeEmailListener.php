<?php

namespace App\Infrastructure\Event;

use App\Domain\Event\UserRegisteredEvent;

class WelcomeEmailListener
{
    public function __invoke(UserRegisteredEvent $event): void
    {
        // Simulación de envío de email
        echo "Sending welcome email to " . $event->user()->email()->value() . "\n";
    }
}