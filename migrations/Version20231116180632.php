<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116180632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assets_manager ADD date_bought DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD date_received DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD eliminated BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD owner VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD workplace VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD complaint TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD next_service_due DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD service_interval TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assets_manager DROP date_bought');
        $this->addSql('ALTER TABLE assets_manager DROP date_received');
        $this->addSql('ALTER TABLE assets_manager DROP eliminated');
        $this->addSql('ALTER TABLE assets_manager DROP owner');
        $this->addSql('ALTER TABLE assets_manager DROP category');
        $this->addSql('ALTER TABLE assets_manager DROP workplace');
        $this->addSql('ALTER TABLE assets_manager DROP complaint');
        $this->addSql('ALTER TABLE assets_manager DROP next_service_due');
        $this->addSql('ALTER TABLE assets_manager DROP service_interval');
    }
}
