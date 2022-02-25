<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220225223711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('TRUNCATE offer');
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer ADD email VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE offer ADD google_maps_link VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE offer RENAME COLUMN person TO persons');
    }

    public function down(Schema $schema): void
    {

        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE offer DROP email');
        $this->addSql('ALTER TABLE offer DROP google_maps_link');
        $this->addSql('ALTER TABLE offer ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE offer RENAME COLUMN persons TO person');
    }
}
