<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413143018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance ADD departement VARCHAR(255) DEFAULT NULL, ADD periode VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE stage CHANGE departement departement VARCHAR(255) NOT NULL, CHANGE periode periode VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP departement, DROP periode');
        $this->addSql('ALTER TABLE stage CHANGE departement departement VARCHAR(255) DEFAULT NULL, CHANGE periode periode VARCHAR(255) DEFAULT NULL');
    }
}
