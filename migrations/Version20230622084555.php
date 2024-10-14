<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622084555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieu_vente ADD COLUMN nbr_boxes INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE lieu_vente ADD COLUMN commentaires VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lieu_vente AS SELECT id, libelle FROM lieu_vente');
        $this->addSql('DROP TABLE lieu_vente');
        $this->addSql('CREATE TABLE lieu_vente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO lieu_vente (id, libelle) SELECT id, libelle FROM __temp__lieu_vente');
        $this->addSql('DROP TABLE __temp__lieu_vente');
    }
}
