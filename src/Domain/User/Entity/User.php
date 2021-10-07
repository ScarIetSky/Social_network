<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private int $age;

    private array $friends = [];

    private string $id;

    private string $interests;

    /**
     */
    private $login;

    /**
     * @var string The hashed password
     */
    private $password;

    /**
     */
    private $roles = ['ROLE_USER'];

    private string $sex;

    /**
     * @param string $id
     * @param string $login
     * @param string $password
     * @param string $sex
     * @param int    $age
     * @param string $interests
     */
    public function __construct(
        string $id,
        string $login,
        string $password,
        string $sex,
        int $age,
        string $interests
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->sex = $sex;
        $this->age = $age;
        $this->interests = $interests;
    }

    public function addFriend(string $id): void
    {
        if ($id === $this->id) {
            return;
        }

        if (!in_array($id, $this->friends, true)) {
            $this->friends[] = $id;
        }
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    public function getFriends(): array
    {
        return $this->friends;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInterests(): string
    {
        return $this->interests;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }
}
