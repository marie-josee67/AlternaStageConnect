<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415075237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alternance ADD CONSTRAINT FK_445F37B9B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_445F37B9B03A8386 ON alternance (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B9B03A8386');
        $this->addSql('DROP INDEX IDX_445F37B9B03A8386 ON alternance');
        $this->addSql('ALTER TABLE alternance DROP created_by_id');
    }
}
