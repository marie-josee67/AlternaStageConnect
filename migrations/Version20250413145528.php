<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413145528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }
    
    public function up(Schema $schema): void
    {
        // Vérifie si la colonne 'periode' existe avant de tenter de la supprimer
        if ($schema->getTable('alternance')->hasColumn('periode')) {
            $this->addSql('ALTER TABLE alternance DROP periode');
        }
        
        // Modification de la colonne 'departement'
        $this->addSql('ALTER TABLE alternance CHANGE departement departement VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance ADD periode VARCHAR(255) DEFAULT NULL, CHANGE departement departement VARCHAR(255) DEFAULT NULL');
    }
}
