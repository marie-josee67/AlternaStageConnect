<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404123116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alternance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, metier VARCHAR(100) NOT NULL, titre VARCHAR(100) NOT NULL, date_creat DATETIME NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, date_ouverture DATETIME DEFAULT NULL, date_cloture DATETIME DEFAULT NULL, description LONGTEXT NOT NULL, mission LONGTEXT NOT NULL, processus LONGTEXT DEFAULT NULL, annee_experience INT NOT NULL, reconversible TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alternance');
    }
}
