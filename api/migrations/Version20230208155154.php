<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208155154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE auction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE auction (id INT NOT NULL, creator_id INT NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, start_price DOUBLE PRECISION NOT NULL, actual_price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DEE4F59361220EA6 ON auction (creator_id)');
        $this->addSql('COMMENT ON COLUMN auction.end_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F59361220EA6 FOREIGN KEY (creator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE auction_id_seq CASCADE');
        $this->addSql('ALTER TABLE auction DROP CONSTRAINT FK_DEE4F59361220EA6');
        $this->addSql('DROP TABLE auction');
    }
}
