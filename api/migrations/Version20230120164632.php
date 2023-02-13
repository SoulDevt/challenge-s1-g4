<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120164632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE demande_vendor_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE demande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE demande (id INT NOT NULL, who_user_id INT NOT NULL, type VARCHAR(255) NOT NULL, accepted BOOLEAN NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postalcode VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2694D7A54B7011EC ON demande (who_user_id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A54B7011EC FOREIGN KEY (who_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_vendor DROP CONSTRAINT fk_b76675194b7011ec');
        $this->addSql('DROP TABLE demande_vendor');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE demande_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE demande_vendor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE demande_vendor (id INT NOT NULL, who_user_id INT NOT NULL, type VARCHAR(255) NOT NULL, accepted BOOLEAN DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postalcode VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b76675194b7011ec ON demande_vendor (who_user_id)');
        $this->addSql('ALTER TABLE demande_vendor ADD CONSTRAINT fk_b76675194b7011ec FOREIGN KEY (who_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande DROP CONSTRAINT FK_2694D7A54B7011EC');
        $this->addSql('DROP TABLE demande');
    }
}
