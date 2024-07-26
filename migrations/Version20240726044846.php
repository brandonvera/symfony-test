<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240726044846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `rating` (
                id CHAR(36) PRIMARY KEY,
                content CHAR(36),
                user CHAR(36),
                value INT,
                FOREIGN KEY (content) REFERENCES `content` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                FOREIGN KEY (user) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB
        ');

        $this->addSql('
            CREATE TABLE `favorite` (
                id CHAR(36) PRIMARY KEY,
                content CHAR(36),
                user CHAR(36),
                FOREIGN KEY (content) REFERENCES `content` (id) ON UPDATE CASCADE ON DELETE CASCADE,
                FOREIGN KEY (user) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB
        ');

        $this->addSql('
            ALTER TABLE `content`
            ADD COLUMN ratings CHAR(36) DEFAULT NULL,
            ADD COLUMN favorites CHAR(36) DEFAULT NULL
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `rating`');
        $this->addSql('DROP TABLE `favorite`');
        $this->addSql('ALTER TABLE `content` DROP COLUMN ratings');
        $this->addSql('ALTER TABLE `content` DROP COLUMN favorites');
    }
}
