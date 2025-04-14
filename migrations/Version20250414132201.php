<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414132201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B9A76ED395');
        $this->addSql('ALTER TABLE alternance CHANGE departement departement VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE alternance ADD CONSTRAINT FK_445F37B9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369A76ED395');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B9A76ED395');
        $this->addSql('ALTER TABLE alternance CHANGE departement departement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE alternance ADD CONSTRAINT FK_445F37B9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369A76ED395');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
