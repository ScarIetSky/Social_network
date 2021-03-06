<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;

/**
 *
 */
interface UserRepository
{
    public function add(User $user): void;

    public function findAll(string $name = null, string $surname = null): array;

    public function update(User $user): void;

    public function findOne(string $login): User;

    public function findOneById(string $id): User;
}
