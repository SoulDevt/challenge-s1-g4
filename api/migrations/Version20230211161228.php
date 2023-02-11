<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211161228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_object_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE items (id INT NOT NULL, sold_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E11EE94DC8C84E7D ON items (sold_id)');
        $this->addSql('CREATE TABLE media_object (id INT NOT NULL, items_id INT DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14D431326BB0AE84 ON media_object (items_id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DC8C84E7D FOREIGN KEY (sold_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media_object ADD CONSTRAINT FK_14D431326BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD items_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" DROP is_verified');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6496BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D6496BB0AE84 ON "user" (items_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6496BB0AE84');
        $this->addSql('DROP SEQUENCE items_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE media_object_id_seq CASCADE');
        $this->addSql('ALTER TABLE items DROP CONSTRAINT FK_E11EE94DC8C84E7D');
        $this->addSql('ALTER TABLE media_object DROP CONSTRAINT FK_14D431326BB0AE84');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP INDEX IDX_8D93D6496BB0AE84');
        $this->addSql('ALTER TABLE "user" ADD is_verified BOOLEAN DEFAULT false');
        $this->addSql('ALTER TABLE "user" DROP items_id');
    }
}
