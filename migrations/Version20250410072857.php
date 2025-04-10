<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410072857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE alternance ADD CONSTRAINT FK_445F37B9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_445F37B9A76ED395 ON alternance (user_id)');
        $this->addSql('ALTER TABLE stage ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369A76ED395 ON stage (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B9A76ED395');
        $this->addSql('DROP INDEX IDX_445F37B9A76ED395 ON alternance');
        $this->addSql('ALTER TABLE alternance DROP user_id');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369A76ED395');
        $this->addSql('DROP INDEX IDX_C27C9369A76ED395 ON stage');
        $this->addSql('ALTER TABLE stage DROP user_id');
    }
}
