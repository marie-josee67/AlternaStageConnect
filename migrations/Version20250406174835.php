<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250406174835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD annonce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E58805AB2F FOREIGN KEY (annonce_id) REFERENCES cathegorie (id)');
        $this->addSql('CREATE INDEX IDX_F65593E58805AB2F ON annonce (annonce_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E58805AB2F');
        $this->addSql('DROP INDEX IDX_F65593E58805AB2F ON annonce');
        $this->addSql('ALTER TABLE annonce DROP annonce_id');
    }
}
