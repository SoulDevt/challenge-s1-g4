<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118095004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE items (id INT NOT NULL, sold_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, pictures TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E11EE94DC8C84E7D ON items (sold_id)');
        $this->addSql('COMMENT ON COLUMN items.pictures IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, items_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, postal_address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, postal_code INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON "user" (name)');
        $this->addSql('CREATE INDEX IDX_8D93D6496BB0AE84 ON "user" (items_id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DC8C84E7D FOREIGN KEY (sold_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6496BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE items_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE items DROP CONSTRAINT FK_E11EE94DC8C84E7D');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6496BB0AE84');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE "user"');
    }
}
