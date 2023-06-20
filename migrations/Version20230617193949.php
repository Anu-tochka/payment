<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617193949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salary (id INT AUTO_INCREMENT NOT NULL, pers_id INT DEFAULT NULL, debt DOUBLE PRECISION NOT NULL, payday DATE NOT NULL, payment DOUBLE PRECISION NOT NULL, keep DOUBLE PRECISION DEFAULT NULL, INDEX IDX_9413BB714AA53143 (pers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salary ADD CONSTRAINT FK_9413BB714AA53143 FOREIGN KEY (pers_id) REFERENCES pers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary DROP FOREIGN KEY FK_9413BB714AA53143');
        $this->addSql('DROP TABLE salary');
    }
}
