<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617184314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE single (id INT AUTO_INCREMENT NOT NULL, pers_id INT DEFAULT NULL, year SMALLINT NOT NULL, month SMALLINT NOT NULL, description VARCHAR(255) DEFAULT NULL, payment DOUBLE PRECISION DEFAULT NULL, sign VARCHAR(1) DEFAULT NULL, INDEX IDX_CAA727194AA53143 (pers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE single ADD CONSTRAINT FK_CAA727194AA53143 FOREIGN KEY (pers_id) REFERENCES pers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE single DROP FOREIGN KEY FK_CAA727194AA53143');
        $this->addSql('DROP TABLE single');
    }
}
