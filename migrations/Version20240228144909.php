<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228144909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__produit AS SELECT id, nom, prix, quantite, rupture, lien_image FROM produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference_id INTEGER DEFAULT NULL, nom VARCHAR(200) NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INTEGER NOT NULL, rupture BOOLEAN NOT NULL, lien_image VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_29A5EC271645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO produit (id, nom, prix, quantite, rupture, lien_image) SELECT id, nom, prix, quantite, rupture, lien_image FROM __temp__produit');
        $this->addSql('DROP TABLE __temp__produit');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC271645DEA9 ON produit (reference_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__produit AS SELECT id, nom, prix, quantite, rupture, lien_image FROM produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('CREATE TABLE produit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INTEGER NOT NULL, rupture BOOLEAN NOT NULL, lien_image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO produit (id, nom, prix, quantite, rupture, lien_image) SELECT id, nom, prix, quantite, rupture, lien_image FROM __temp__produit');
        $this->addSql('DROP TABLE __temp__produit');
    }
}
