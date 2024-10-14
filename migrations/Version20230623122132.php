<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623122132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente ADD COLUMN description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__vente AS SELECT id, id_lieu_vente_id, id_categorie_vente_id, nom, date_vente, image_vente FROM vente');
        $this->addSql('DROP TABLE vente');
        $this->addSql('CREATE TABLE vente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_lieu_vente_id INTEGER NOT NULL, id_categorie_vente_id INTEGER NOT NULL, nom VARCHAR(150) NOT NULL, date_vente DATETIME NOT NULL, image_vente VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_888A2A4C140390B9 FOREIGN KEY (id_lieu_vente_id) REFERENCES lieu_vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_888A2A4CC662E4CF FOREIGN KEY (id_categorie_vente_id) REFERENCES categorie_vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vente (id, id_lieu_vente_id, id_categorie_vente_id, nom, date_vente, image_vente) SELECT id, id_lieu_vente_id, id_categorie_vente_id, nom, date_vente, image_vente FROM __temp__vente');
        $this->addSql('DROP TABLE __temp__vente');
        $this->addSql('CREATE INDEX IDX_888A2A4C140390B9 ON vente (id_lieu_vente_id)');
        $this->addSql('CREATE INDEX IDX_888A2A4CC662E4CF ON vente (id_categorie_vente_id)');
    }
}
