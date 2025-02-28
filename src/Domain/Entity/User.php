<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private UserId $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    public function __construct(UserId $id, Name $name, Email $email, Password $password)
    {
        $this->id = $id;
        $this->name = $name->value();
        $this->email = $email->value();
        $this->password = $password->value();
        $this->createdAt = new DateTimeImmutable();
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return new Name($this->name);
    }

    public function email(): Email
    {
        return new Email($this->email);
    }

    public function password(): Password
    {
        return new Password($this->password); // Esto asume que Password acepta un hash como entrada
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}