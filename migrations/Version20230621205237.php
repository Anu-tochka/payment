<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621205237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment CHANGE debt debt DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D4AA53143 FOREIGN KEY (pers_id) REFERENCES pers (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D4AA53143 ON payment (pers_id)');
        $this->addSql('ALTER TABLE pers CHANGE passport_d passport_d VARCHAR(12) DEFAULT NULL');
        $this->addSql('ALTER TABLE work ADD dep_id INT NOT NULL');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880814AA86C FOREIGN KEY (dep_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_534E6880814AA86C ON work (dep_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D4AA53143');
        $this->addSql('DROP INDEX IDX_6D28840D4AA53143 ON payment');
        $this->addSql('ALTER TABLE payment CHANGE debt debt DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pers CHANGE passport_d passport_d DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E6880814AA86C');
        $this->addSql('DROP INDEX IDX_534E6880814AA86C ON work');
        $this->addSql('ALTER TABLE work DROP dep_id');
    }
}
