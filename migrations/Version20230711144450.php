<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230711144450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers ADD works_id INT NOT NULL');
        $this->addSql('ALTER TABLE pers ADD CONSTRAINT FK_D0624DB9F6CB822A FOREIGN KEY (works_id) REFERENCES work (id)');
        $this->addSql('CREATE INDEX IDX_D0624DB9F6CB822A ON pers (works_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pers DROP FOREIGN KEY FK_D0624DB9F6CB822A');
        $this->addSql('DROP INDEX IDX_D0624DB9F6CB822A ON pers');
        $this->addSql('ALTER TABLE pers DROP works_id');
    }
}
