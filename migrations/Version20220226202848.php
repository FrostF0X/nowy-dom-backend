<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220226202848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('TRUNCATE notification');
        $this->addSql('ALTER TABLE notification ADD body TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE notification ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE notification RENAME COLUMN text TO title');
        $this->addSql('COMMENT ON COLUMN notification.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN notification.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE notification ADD text TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification DROP title');
        $this->addSql('ALTER TABLE notification DROP body');
        $this->addSql('ALTER TABLE notification DROP created_at');
        $this->addSql('ALTER TABLE notification DROP updated_at');
    }
}
