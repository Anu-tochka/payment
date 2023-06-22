<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622211848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary ADD pers_id INT DEFAULT NULL, ADD total DOUBLE PRECISION DEFAULT NULL, ADD workdays SMALLINT DEFAULT NULL, ADD truancy SMALLINT DEFAULT NULL, ADD sickdays SMALLINT DEFAULT NULL, ADD vacation SMALLINT DEFAULT NULL, ADD expense SMALLINT DEFAULT NULL, ADD vacationpay DOUBLE PRECISION DEFAULT NULL, ADD debt DOUBLE PRECISION DEFAULT NULL, ADD keep DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE salary ADD CONSTRAINT FK_9413BB714AA53143 FOREIGN KEY (pers_id) REFERENCES pers (id)');
        $this->addSql('CREATE INDEX IDX_9413BB714AA53143 ON salary (pers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salary DROP FOREIGN KEY FK_9413BB714AA53143');
        $this->addSql('DROP INDEX IDX_9413BB714AA53143 ON salary');
        $this->addSql('ALTER TABLE salary DROP pers_id, DROP total, DROP workdays, DROP truancy, DROP sickdays, DROP vacation, DROP expense, DROP vacationpay, DROP debt, DROP keep');
    }
}
