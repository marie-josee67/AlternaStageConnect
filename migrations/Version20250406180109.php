<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250406180109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competences_stage DROP FOREIGN KEY FK_9BA49012298D193');
        $this->addSql('ALTER TABLE competences_stage DROP FOREIGN KEY FK_9BA4901A660B158');
        $this->addSql('DROP TABLE competences_stage');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences_stage (competences_id INT NOT NULL, stage_id INT NOT NULL, INDEX IDX_9BA4901A660B158 (competences_id), INDEX IDX_9BA49012298D193 (stage_id), PRIMARY KEY(competences_id, stage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competences_stage ADD CONSTRAINT FK_9BA49012298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_stage ADD CONSTRAINT FK_9BA4901A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
    }
}
