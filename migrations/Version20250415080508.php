<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415080508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369B03A8386 ON stage (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369B03A8386');
        $this->addSql('DROP INDEX IDX_C27C9369B03A8386 ON stage');
        $this->addSql('ALTER TABLE stage DROP created_by_id');
    }
}
