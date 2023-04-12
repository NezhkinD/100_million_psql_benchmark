<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230408091607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE product_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vendor_entity_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE shop.product_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop.vendor_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE shop.product_entity (id INT NOT NULL, vendor_id_id INT NOT NULL, model VARCHAR(255) NOT NULL, uniq_code VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4352058E69029C17 ON shop.product_entity (vendor_id_id)');
        $this->addSql('CREATE TABLE shop.vendor_entity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE shop.product_entity ADD CONSTRAINT FK_4352058E69029C17 FOREIGN KEY (vendor_id_id) REFERENCES shop.vendor_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_entity DROP CONSTRAINT fk_6c5405cc69029c17');
        $this->addSql('DROP TABLE vendor_entity');
        $this->addSql('DROP TABLE product_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE shop.product_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop.vendor_entity_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE product_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vendor_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vendor_entity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_entity (id INT NOT NULL, vendor_id_id INT NOT NULL, model VARCHAR(255) NOT NULL, uniq_code VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_6c5405cc69029c17 ON product_entity (vendor_id_id)');
        $this->addSql('ALTER TABLE product_entity ADD CONSTRAINT fk_6c5405cc69029c17 FOREIGN KEY (vendor_id_id) REFERENCES vendor_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop.product_entity DROP CONSTRAINT FK_4352058E69029C17');
        $this->addSql('DROP TABLE shop.product_entity');
        $this->addSql('DROP TABLE shop.vendor_entity');
    }
}
