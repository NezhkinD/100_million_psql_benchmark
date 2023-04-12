<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824140104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание схем БД';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('CREATE SCHEMA IF NOT EXISTS shop');
    }

    public function down(Schema $schema): void
    {
    }
}
