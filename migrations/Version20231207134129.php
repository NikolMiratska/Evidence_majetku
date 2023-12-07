<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207134129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE asset_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE assets_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE assets_location_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE assets_workplace_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE asset_type (id INT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE assets_category (id INT NOT NULL, category VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE assets_location (id INT NOT NULL, location VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE assets_workplace (id INT NOT NULL, workplace VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE assets_manager ADD type_asset_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD location_asset_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD workplace_asset_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD category_asset_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assets_manager ADD CONSTRAINT FK_68C2AFF3C8253EBD FOREIGN KEY (type_asset_id) REFERENCES asset_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assets_manager ADD CONSTRAINT FK_68C2AFF3D48F3BA3 FOREIGN KEY (location_asset_id) REFERENCES assets_location (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assets_manager ADD CONSTRAINT FK_68C2AFF3C00CC7D8 FOREIGN KEY (workplace_asset_id) REFERENCES assets_workplace (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE assets_manager ADD CONSTRAINT FK_68C2AFF3B2A09D3A FOREIGN KEY (category_asset_id) REFERENCES assets_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_68C2AFF3C8253EBD ON assets_manager (type_asset_id)');
        $this->addSql('CREATE INDEX IDX_68C2AFF3D48F3BA3 ON assets_manager (location_asset_id)');
        $this->addSql('CREATE INDEX IDX_68C2AFF3C00CC7D8 ON assets_manager (workplace_asset_id)');
        $this->addSql('CREATE INDEX IDX_68C2AFF3B2A09D3A ON assets_manager (category_asset_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assets_manager DROP CONSTRAINT FK_68C2AFF3C8253EBD');
        $this->addSql('ALTER TABLE assets_manager DROP CONSTRAINT FK_68C2AFF3B2A09D3A');
        $this->addSql('ALTER TABLE assets_manager DROP CONSTRAINT FK_68C2AFF3D48F3BA3');
        $this->addSql('ALTER TABLE assets_manager DROP CONSTRAINT FK_68C2AFF3C00CC7D8');
        $this->addSql('DROP SEQUENCE asset_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE assets_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE assets_location_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE assets_workplace_id_seq CASCADE');
        $this->addSql('DROP TABLE asset_type');
        $this->addSql('DROP TABLE assets_category');
        $this->addSql('DROP TABLE assets_location');
        $this->addSql('DROP TABLE assets_workplace');
        $this->addSql('DROP INDEX IDX_68C2AFF3C8253EBD');
        $this->addSql('DROP INDEX IDX_68C2AFF3D48F3BA3');
        $this->addSql('DROP INDEX IDX_68C2AFF3C00CC7D8');
        $this->addSql('DROP INDEX IDX_68C2AFF3B2A09D3A');
        $this->addSql('ALTER TABLE assets_manager DROP type_asset_id');
        $this->addSql('ALTER TABLE assets_manager DROP location_asset_id');
        $this->addSql('ALTER TABLE assets_manager DROP workplace_asset_id');
        $this->addSql('ALTER TABLE assets_manager DROP category_asset_id');
    }
}
