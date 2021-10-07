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
        $this->connection->beginTransaction();
        $query = $this->connection->prepare(
            "INSERT INTO user (id, login, password, roles, sex, age, interests) " .
            "VALUES (:id, :login, :password, :roles, :sex, :age, :interests);"
        );
        $query->bindValue('id', $user->getId());
        $query->bindValue('login', $user->getLogin());
        $query->bindValue('password', $user->getPassword());
        $query->bindValue('roles', json_encode($user->getRoles()));
        $query->bindValue('sex', $user->getSex());
        $query->bindValue('age', $user->getAge());
        $query->bindValue('interests', $user->getInterests());

        $query->execute();

        $friendsData = '';

        foreach ($user->getFriends() as $friend) {
            $friendsData .= sprintf("('%s', '%s'),", $user->getId(), $friend);
            $friendsData .= sprintf("('%s', '%s'),", $friend, $user->getId());
        }

        if ($friendsData !== '') {

            $query = $this->connection->query(
                sprintf(
                    'INSERT IGNORE INTO users_friends (users_id, friends_id) VALUES %s;',
                    rtrim($friendsData, ',')
                )
            );

            $query->execute();
        }

        $this->connection->commit();
    }

    public function findAll(): array
    {
        $query = $this->connection->query('SELECT * FROM user;');

        foreach ($query->fetchAllAssociative() as $userData) {
            $user = new User(
                $userData['id'],
                $userData['login'],
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
        // $query = $this->connection->prepare(
        //     "SELECT * FROM user WHERE login = ':login';"
        // );
        //
        // $query->bindValue('login', $login, ParameterType::STRING);

        $query = $this->connection->query(
            sprintf(
                'SELECT * FROM user WHERE login = %s;',
                $this->connection->quote($login, ParameterType::STRING)
            )
        );

        $result = $query->fetchAssociative();

        if ($result === false) {
            throw new \RuntimeException('Not found');
        }

        $user = new User(
            $result['id'],
            $result['login'],
            $result['password'],
            $result['sex'],
            (int) $result['age'],
            $result['interests'],
        );

        $user->setRoles(json_decode($result['roles'], true));

        $query = $this->connection->query(
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
        $query = $this->connection->query(
            sprintf(
                'SELECT * FROM user WHERE id = %s;',
                $this->connection->quote($id, ParameterType::STRING)
            )
        );

        $result = $query->fetchAssociative();

        if ($result === false) {
            throw new \RuntimeException('Not found');
        }

        $user = new User(
            $result['id'],
            $result['login'],
            $result['password'],
            $result['sex'],
            (int) $result['age'],
            $result['interests'],
        );

        $user->setRoles(json_decode($result['roles'], true));

        $query = $this->connection->query(
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
        $this->connection->beginTransaction();

        $query = $this->connection->prepare(
            "UPDATE user SET login = :login, password = :password, roles = :roles," .
            " sex = :sex, age = :age, interests = :interests " .
            "WHERE id = :id;"
        );

        $query->bindValue('login', $user->getLogin());
        $query->bindValue('password', $user->getPassword());
        $query->bindValue('roles', json_encode($user->getRoles()));
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
            $query = $this->connection->query(
                sprintf(
                    'INSERT IGNORE INTO users_friends (users_id, friends_id) VALUES %s;',
                    rtrim($friendsData, ',')
                )
            );

            $query->execute();
        }

        $this->connection->commit();
    }
}
