<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228154144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_distributeur (produit_id INTEGER NOT NULL, distributeur_id INTEGER NOT NULL, PRIMARY KEY(produit_id, distributeur_id), CONSTRAINT FK_E3D5370CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E3D5370C29EB7ACA FOREIGN KEY (distributeur_id) REFERENCES distributeur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E3D5370CF347EFB ON produit_distributeur (produit_id)');
        $this->addSql('CREATE INDEX IDX_E3D5370C29EB7ACA ON produit_distributeur (distributeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit_distributeur');
    }
}
