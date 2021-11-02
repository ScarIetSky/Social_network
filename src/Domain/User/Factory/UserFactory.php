<?php

declare(strict_types=1);

namespace App\Domain\User\Factory;

use App\Domain\User\Entity\User;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 *
 */
class UserFactory
{

    private UserPasswordHasherInterface $userPasswordHasherInterface;

    /**
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function create(
        string $login,
        string $name,
        string $surname,
        string $password,
        string $sex,
        int $age,
        string $interests
    ): User {
        $id = Uuid::uuid4()->toString();

        $user = new User(
            $id,
            $login,
            $name,
            $surname,
            $password,
            $sex,
            $age,
            $interests
        );

        $password = $this->userPasswordHasherInterface->hashPassword($user, $password);
        $user->setPassword($password);

        return $user;
    }
}
