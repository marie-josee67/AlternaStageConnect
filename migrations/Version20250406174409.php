<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250406174409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences_alternance (competences_id INT NOT NULL, alternance_id INT NOT NULL, INDEX IDX_19D8B6BFA660B158 (competences_id), INDEX IDX_19D8B6BFC71DECBA (alternance_id), PRIMARY KEY(competences_id, alternance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competences_alternance ADD CONSTRAINT FK_19D8B6BFA660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_alternance ADD CONSTRAINT FK_19D8B6BFC71DECBA FOREIGN KEY (alternance_id) REFERENCES alternance (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competences_alternance DROP FOREIGN KEY FK_19D8B6BFA660B158');
        $this->addSql('ALTER TABLE competences_alternance DROP FOREIGN KEY FK_19D8B6BFC71DECBA');
        $this->addSql('DROP TABLE competences_alternance');
    }
}
