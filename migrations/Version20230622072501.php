<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622072501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cheval ADD COLUMN image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cheval AS SELECT id, nom, sexe, num_sire FROM cheval');
        $this->addSql('DROP TABLE cheval');
        $this->addSql('CREATE TABLE cheval (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, num_sire VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO cheval (id, nom, sexe, num_sire) SELECT id, nom, sexe, num_sire FROM __temp__cheval');
        $this->addSql('DROP TABLE __temp__cheval');
    }
}
