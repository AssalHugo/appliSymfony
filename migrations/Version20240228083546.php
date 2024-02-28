<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228083546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD COLUMN lien_image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__produit AS SELECT id, nom, prix, quantite, rupture FROM produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INTEGER NOT NULL, rupture BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO produit (id, nom, prix, quantite, rupture) SELECT id, nom, prix, quantite, rupture FROM __temp__produit');
        $this->addSql('DROP TABLE __temp__produit');
    }
}
