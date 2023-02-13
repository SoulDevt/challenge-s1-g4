<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118140025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE demande_vendor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE demande_vendor (id INT NOT NULL, who_user_id INT NOT NULL, type VARCHAR(255) NOT NULL, accepted BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B76675194B7011EC ON demande_vendor (who_user_id)');
        $this->addSql('ALTER TABLE demande_vendor ADD CONSTRAINT FK_B76675194B7011EC FOREIGN KEY (who_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE demande_vendor_id_seq CASCADE');
        $this->addSql('ALTER TABLE demande_vendor DROP CONSTRAINT FK_B76675194B7011EC');
        $this->addSql('DROP TABLE demande_vendor');
    }
}
