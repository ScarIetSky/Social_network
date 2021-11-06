<?php

declare(strict_types=1);

namespace App\Persistency\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Repository\UserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 */
class DbalUserRepository implements UserRepository
{
    private ManagerRegistry $managerRegistry;

    private Connection $masterConnection;
    private Connection $slaveConnection;

    private UserFactory $userFactory;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry, UserFactory $userFactory)
    {
        $this->masterConnection = $managerRegistry->getConnection('primary');
        $this->slaveConnection = $managerRegistry->getConnection('replica');
        $this->managerRegistry = $managerRegistry;
        $this->userFactory = $userFactory;
    }


    public function add(User $user): void
    {
        $this->masterConnection->beginTransaction();

        $query = $this->masterConnection->prepare(
            "INSERT INTO user (id, login, password, roles, sex, age, interests, name, surname) " .
            "VALUES (:id, :login, :password, :roles, :sex, :age, :interests, :name, :surname);"
        );
        $query->bindValue('id', $user->getId());
        $query->bindValue('login', $user->getLogin());
        $query->bindValue('password', $user->getPassword());
        $query->bindValue('roles', json_encode($user->getRoles()));
        $query->bindValue('sex', $user->getSex());
        $query->bindValue('age', $user->getAge());
        $query->bindValue('name', $user->getName());
        $query->bindValue('surname', $user->getSurname());
        $query->bindValue('interests', $user->getInterests());

        $query->execute();

        $friendsData = '';

        foreach ($user->getFriends() as $friend) {
            $friendsData .= sprintf("('%s', '%s'),", $user->getId(), $friend);
            $friendsData .= sprintf("('%s', '%s'),", $friend, $user->getId());
        }

        if ($friendsData !== '') {

            $query = $this->masterConnection->query(
                sprintf(
                    'INSERT IGNORE INTO users_friends (users_id, friends_id) VALUES %s;',
                    rtrim($friendsData, ',')
                )
            );

            $query->execute();
        }

        $this->masterConnection->commit();
    }

    public function findAll(string $name = null, string $surname = null): array
    {
        $where = '';

        if ($name) {
            $where = "WHERE name LIKE '$name'";
        }

        if ($surname) {
            $where = "WHERE surname LIKE '$surname'";
        }

        if ($name && $surname) {
            $where = "WHERE name = '$name' AND surname = '$surname'";
        }

        $query = $this->slaveConnection->query(
            sprintf(
                'SELECT * FROM user %s LIMIT 100;',
                $where
            )
        );

        foreach ($query->fetchAllAssociative() as $userData) {
            $user = new User(
                $userData['id'],
                $userData['login'],
                $userData['name'],
                $userData['surname'],
                $userData['password'],
                $userData['sex'],
                (int) $userData['age'],
                $userData['interests'],
            );

            $user->setRoles(json_decode($userData['roles'], true));

            $users[] = $user;
        }

        return $users;
    }

    public function findOne(string $login): User
    {
        $query = $this->slaveConnection->query(
            sprintf(
                'SELECT * FROM user WHERE login = %s;',
                $this->slaveConnection->quote($login, ParameterType::STRING)
            )
        );

        $result = $query->fetchAssociative();

        if ($result === false) {
            throw new \RuntimeException('Not found');
        }

        $user = new User(
            $result['id'],
            $result['login'],
            $result['name'],
            $result['surname'],
            $result['password'],
            $result['sex'],
            (int) $result['age'],
            $result['interests'],
        );

        $user->setRoles(json_decode($result['roles'], true));

        $query = $this->slaveConnection->query(
            sprintf(
                'SELECT * FROM users_friends WHERE users_id = "%s";',
                $user->getId()
            )
        );

        $result = $query->fetchAll();

        if (is_array($result)) {
            foreach ($result as $friend) {
                $user->addFriend(
                    $friend['users_id'] === $user->getId() ? $friend['friends_id'] : $friend['users_id']
                );
            }
        }

        return $user;
    }

    public function findOneById(string $id): User
    {
        $query = $this->slaveConnection->query(
            sprintf(
                'SELECT * FROM user WHERE id = %s;',
                $this->slaveConnection->quote($id, ParameterType::STRING)
            )
        );

        $result = $query->fetchAssociative();

        if ($result === false) {
            throw new \RuntimeException('Not found');
        }

        $user = new User(
            $result['id'],
            $result['login'],
            $result['name'],
            $result['surname'],
            $result['password'],
            $result['sex'],
            (int) $result['age'],
            $result['interests'],
        );

        $user->setRoles(json_decode($result['roles'], true));

        $query = $this->slaveConnection->query(
            sprintf(
                'SELECT * FROM users_friends WHERE users_id = "%s";',
                $user->getId()
            )
        );

        $result = $query->fetchAll();

        if (is_array($result)) {
            foreach ($result as $friend) {
                $user->addFriend(
                    $friend['users_id'] === $user->getId() ? $friend['friends_id'] : $friend['users_id']
                );
            }
        }

        return $user;
    }

    public function update(User $user): void
    {
        $this->masterConnection->beginTransaction();

        $query = $this->masterConnection->prepare(
            "UPDATE user SET login = :login, password = :password, roles = :roles," .
            " sex = :sex, age = :age, interests = :interests, name = :name, surname = :surname;" .
            "WHERE id = :id;"
        );

        $query->bindValue('login', $user->getLogin());
        $query->bindValue('password', $user->getPassword());
        $query->bindValue('roles', json_encode($user->getRoles()));
        $query->bindValue('name', $user->getName());
        $query->bindValue('surname', $user->getSurname());
        $query->bindValue('sex', $user->getSex());
        $query->bindValue('age', $user->getAge());
        $query->bindValue('interests', $user->getInterests());
        $query->bindValue('id', $user->getId());
        $query->execute();

        $friendsData = '';

        foreach ($user->getFriends() as $friend) {
            $friendsData .= sprintf("('%s', '%s'),", $user->getId(), $friend);
            $friendsData .= sprintf("('%s', '%s'),", $friend, $user->getId());
        }

        if ($friendsData !== '') {
            $query = $this->masterConnection->query(
                sprintf(
                    'INSERT IGNORE INTO users_friends (users_id, friends_id) VALUES %s;',
                    rtrim($friendsData, ',')
                )
            );

            $query->execute();
        }

        $this->masterConnection->commit();
    }
}
