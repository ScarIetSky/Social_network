<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add table for storing users' friends.
 */
final class Version20211006105535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'users friends';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE users_friends ' .
            '(users_id VARCHAR(50) NOT NULL, friends_id VARCHAR(50) NOT NULL,' .
            'UNIQUE INDEX UNIQ_8D93D649AA08CB11 (users_id, friends_id)) DEFAULT CHARACTER SET utf8mb4' .
            ' COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users_friends');
    }
}
