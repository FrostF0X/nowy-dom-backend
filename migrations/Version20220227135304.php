<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220227135304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('TRUNCATE notification');
        $this->addSql('ALTER TABLE notification ADD signal VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE notification ALTER title SET NOT NULL');
        $this->addSql('ALTER TABLE notification ALTER body SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE notification DROP signal');
        $this->addSql('ALTER TABLE notification ALTER title DROP NOT NULL');
        $this->addSql('ALTER TABLE notification ALTER body DROP NOT NULL');
    }
}
