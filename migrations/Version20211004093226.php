<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add table for storing users.
 */
final class Version20211004093226 extends AbstractMigration
{
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }

    public function getDescription(): string
    {
        return 'users table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE user ' .
            '(id VARCHAR(50) NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) ' .
            'NOT NULL, interests TEXT NOT NULL, age INT(3) NOT NULL, sex VARCHAR(6),' .
            ' UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4' .
            ' COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }
}
