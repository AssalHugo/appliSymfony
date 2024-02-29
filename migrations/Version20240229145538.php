<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229145538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__panier AS SELECT id, nb_produit FROM panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('CREATE TABLE panier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_produit_id INTEGER DEFAULT NULL, nb_produit INTEGER NOT NULL, CONSTRAINT FK_24CC0DF2AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES reference (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO panier (id, nb_produit) SELECT id, nb_produit FROM __temp__panier');
        $this->addSql('DROP TABLE __temp__panier');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF2AABEFE2C ON panier (id_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__panier AS SELECT id, nb_produit FROM panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('CREATE TABLE panier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nb_produit INTEGER NOT NULL, id_produit INTEGER NOT NULL)');
        $this->addSql('INSERT INTO panier (id, nb_produit) SELECT id, nb_produit FROM __temp__panier');
        $this->addSql('DROP TABLE __temp__panier');
    }
}
