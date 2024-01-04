<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103002237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_history (id INT NOT NULL, asset_id INT DEFAULT NULL, user_name_id INT DEFAULT NULL, action VARCHAR(255) DEFAULT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7FB76E415DA1941 ON user_history (asset_id)');
        $this->addSql('CREATE INDEX IDX_7FB76E41291A82DC ON user_history (user_name_id)');
        $this->addSql('ALTER TABLE user_history ADD CONSTRAINT FK_7FB76E415DA1941 FOREIGN KEY (asset_id) REFERENCES assets_manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_history ADD CONSTRAINT FK_7FB76E41291A82DC FOREIGN KEY (user_name_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE user_history_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_history DROP CONSTRAINT FK_7FB76E415DA1941');
        $this->addSql('ALTER TABLE user_history DROP CONSTRAINT FK_7FB76E41291A82DC');
        $this->addSql('DROP TABLE user_history');
    }
}
