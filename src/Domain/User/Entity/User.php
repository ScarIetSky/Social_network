<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{

    private $roles;

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
