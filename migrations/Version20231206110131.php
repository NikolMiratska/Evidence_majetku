<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206110131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assets_manager ADD owned_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD CONSTRAINT FK_68C2AFF35E70BCD7 FOREIGN KEY (owned_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68C2AFF35E70BCD7 ON assets_manager (owned_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assets_manager DROP CONSTRAINT FK_68C2AFF35E70BCD7');
        $this->addSql('DROP INDEX IDX_68C2AFF35E70BCD7');
        $this->addSql('ALTER TABLE assets_manager DROP owned_by_id');
    }
}
