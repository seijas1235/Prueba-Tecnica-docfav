<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id->value());
    }

    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }

    public function findByEmail(string $email): ?User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
    }
}