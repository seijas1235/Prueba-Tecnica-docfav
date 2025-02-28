<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\WeakPasswordException;

class Password
{
    private string $hashedPassword;

    // Valida y hashea la contraseña segun politica de seguridad
    public function __construct(string $plainPassword)
    {
        if (!$this->isValid($plainPassword)) {
            throw new WeakPasswordException('La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, un número y un carácter especial');
        }
        $this->hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    // Permite crear instancia desde un hash existente (para Doctrine)
    public static function fromHash(string $hashedPassword): self
    {
        $instance = new self('dummy'); // Constructor dummy para evitar validación
        $instance->hashedPassword = $hashedPassword; // Sobreescribimos el hash
        return $instance;
    }

    private function isValid(string $password): bool
    {
        return strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[0-9]/', $password) &&
            preg_match('/[^a-zA-Z0-9]/', $password);
    }

    public function value(): string
    {
        return $this->hashedPassword;
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }
}