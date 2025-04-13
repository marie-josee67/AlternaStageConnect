<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413132949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B9C71DECBA');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93692298D193');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E58805AB2F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0197E709F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF02298D193');
        $this->addSql('ALTER TABLE competences_alternance DROP FOREIGN KEY FK_19D8B6BFA660B158');
        $this->addSql('ALTER TABLE competences_alternance DROP FOREIGN KEY FK_19D8B6BFC71DECBA');
        $this->addSql('ALTER TABLE competences_stage DROP FOREIGN KEY FK_9BA4901A660B158');
        $this->addSql('ALTER TABLE competences_stage DROP FOREIGN KEY FK_9BA49012298D193');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE cathegorie');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE competences_alternance');
        $this->addSql('DROP TABLE competences_stage');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP INDEX IDX_445F37B9C71DECBA ON alternance');
        $this->addSql('ALTER TABLE alternance DROP alternance_id');
        $this->addSql('DROP INDEX IDX_C27C93692298D193 ON stage');
        $this->addSql('ALTER TABLE stage DROP stage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, filname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F65593E58805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, avis_id INT DEFAULT NULL, stage_id INT DEFAULT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8F91ABF0197E709F (avis_id), INDEX IDX_8F91ABF02298D193 (stage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cathegorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competences_alternance (competences_id INT NOT NULL, alternance_id INT NOT NULL, INDEX IDX_19D8B6BFA660B158 (competences_id), INDEX IDX_19D8B6BFC71DECBA (alternance_id), PRIMARY KEY(competences_id, alternance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competences_stage (competences_id INT NOT NULL, stage_id INT NOT NULL, INDEX IDX_9BA4901A660B158 (competences_id), INDEX IDX_9BA49012298D193 (stage_id), PRIMARY KEY(competences_id, stage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E58805AB2F FOREIGN KEY (annonce_id) REFERENCES cathegorie (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0197E709F FOREIGN KEY (avis_id) REFERENCES alternance (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF02298D193 FOREIGN KEY (stage_id) REFERENCES stage (id)');
        $this->addSql('ALTER TABLE competences_alternance ADD CONSTRAINT FK_19D8B6BFA660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_alternance ADD CONSTRAINT FK_19D8B6BFC71DECBA FOREIGN KEY (alternance_id) REFERENCES alternance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_stage ADD CONSTRAINT FK_9BA4901A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_stage ADD CONSTRAINT FK_9BA49012298D193 FOREIGN KEY (stage_id) REFERENCES stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alternance ADD alternance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alternance ADD CONSTRAINT FK_445F37B9C71DECBA FOREIGN KEY (alternance_id) REFERENCES metier (id)');
        $this->addSql('CREATE INDEX IDX_445F37B9C71DECBA ON alternance (alternance_id)');
        $this->addSql('ALTER TABLE stage ADD stage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93692298D193 FOREIGN KEY (stage_id) REFERENCES metier (id)');
        $this->addSql('CREATE INDEX IDX_C27C93692298D193 ON stage (stage_id)');
    }
}
