<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211024081624 extends AbstractMigration
{
    public function down(Schema $schema): void
    {
        $this->addSql(
            'ALTER TABLE users_friends ' .
            'DROP COLUMN name;'
        );

        $this->addSql(
            'ALTER TABLE users_friends ' .
            'DROP COLUMN surname;'
        );
    }

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'ALTER TABLE user ' .
            'ADD COLUMN name VARCHAR(255) NOT NULL;'
        );
        $this->addSql(
            'ALTER TABLE user ' .
            'ADD COLUMN surname VARCHAR(255) NOT NULL;'
        );
    }
}
