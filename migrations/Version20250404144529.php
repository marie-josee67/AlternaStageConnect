<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404144529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance CHANGE date_creat date_creat DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE stage CHANGE date_creat date_creat DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance CHANGE date_creat date_creat DATETIME NOT NULL');
        $this->addSql('ALTER TABLE stage CHANGE date_creat date_creat DATETIME NOT NULL');
    }
}
