<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221012123931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant ADD COLUMN image_url VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__plant AS SELECT id, name, size, price, origin, complexity, description FROM plant');
        $this->addSql('DROP TABLE plant');
        $this->addSql('CREATE TABLE plant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, size INTEGER NOT NULL, price INTEGER NOT NULL, origin VARCHAR(255) DEFAULT NULL, complexity INTEGER NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO plant (id, name, size, price, origin, complexity, description) SELECT id, name, size, price, origin, complexity, description FROM __temp__plant');
        $this->addSql('DROP TABLE __temp__plant');
    }
}
