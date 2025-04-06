<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250406173724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance ADD alternance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alternance ADD CONSTRAINT FK_445F37B9C71DECBA FOREIGN KEY (alternance_id) REFERENCES metier (id)');
        $this->addSql('CREATE INDEX IDX_445F37B9C71DECBA ON alternance (alternance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B9C71DECBA');
        $this->addSql('DROP INDEX IDX_445F37B9C71DECBA ON alternance');
        $this->addSql('ALTER TABLE alternance DROP alternance_id');
    }
}
