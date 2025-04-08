<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408073329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE postuler ADD alternance_id INT NOT NULL, ADD stage_id INT NOT NULL');
        $this->addSql('ALTER TABLE postuler ADD CONSTRAINT FK_8EC5A68DC71DECBA FOREIGN KEY (alternance_id) REFERENCES alternance (id)');
        $this->addSql('ALTER TABLE postuler ADD CONSTRAINT FK_8EC5A68D2298D193 FOREIGN KEY (stage_id) REFERENCES stage (id)');
        $this->addSql('CREATE INDEX IDX_8EC5A68DC71DECBA ON postuler (alternance_id)');
        $this->addSql('CREATE INDEX IDX_8EC5A68D2298D193 ON postuler (stage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE postuler DROP FOREIGN KEY FK_8EC5A68DC71DECBA');
        $this->addSql('ALTER TABLE postuler DROP FOREIGN KEY FK_8EC5A68D2298D193');
        $this->addSql('DROP INDEX IDX_8EC5A68DC71DECBA ON postuler');
        $this->addSql('DROP INDEX IDX_8EC5A68D2298D193 ON postuler');
        $this->addSql('ALTER TABLE postuler DROP alternance_id, DROP stage_id');
    }
}
