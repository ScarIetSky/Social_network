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

    public function create(string $login, string $password): User
    {
        $id = Uuid::uuid4()->toString();

        $user = new User(
            $id,
            $login,
            $password
        );

        $password = $this->userPasswordHasherInterface->hashPassword($user, $password);
        $user->setPassword($password);

        return $user;
    }
}
