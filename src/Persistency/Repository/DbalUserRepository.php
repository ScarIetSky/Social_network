<?php

declare(strict_types=1);

namespace App\Persistency\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Repository\UserRepository;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\ParameterType;

/**
 *
 */
class DbalUserRepository implements UserRepository
{
    private Connection $connection;
    private UserFactory $userFactory;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection, UserFactory $userFactory)
    {
        $this->connection = $connection;
        $this->userFactory = $userFactory;
    }


    public function add(User $user): void
    {
        $query = $this->connection->prepare(
            "INSERT INTO user (id, login, password, roles) VALUES (:id, :login, :password, :roles);"
        );
        $query->bindValue('id', $user->getId());
        $query->bindValue('login', $user->getLogin());
        $query->bindValue('password', $user->getPassword());
        $query->bindValue('roles', json_encode($user->getRoles()));

        $query->execute();
    }

    public function findOne(string $login): ?User
    {
        // $query = $this->connection->prepare(
        //     "SELECT * FROM user WHERE login = ':login';"
        // );
        //
        // $query->bindValue('login', $login, ParameterType::STRING);

        $query = $this->connection->query(
            sprintf(
                'SELECT * FROM user WHERE login = %s',
                $this->connection->quote($login, ParameterType::STRING)
            )
        );

        $result = $query->fetchAssociative();

        if ($result === false) {
            throw new \RuntimeException('Not found');
        }

        $user = new User($result['id'], $result['login'], $result['password']);

        return $user->setRoles(json_decode($result['roles'], true));
    }
}
