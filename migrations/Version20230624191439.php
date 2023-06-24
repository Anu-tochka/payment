<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624191439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE day ADD statuses_id INT DEFAULT NULL, ADD pers_id INT NOT NULL');
        $this->addSql('ALTER TABLE day ADD CONSTRAINT FK_E5A029901259C1FF FOREIGN KEY (statuses_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE day ADD CONSTRAINT FK_E5A029904AA53143 FOREIGN KEY (pers_id) REFERENCES pers (id)');
        $this->addSql('CREATE INDEX IDX_E5A029901259C1FF ON day (statuses_id)');
        $this->addSql('CREATE INDEX IDX_E5A029904AA53143 ON day (pers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE day DROP FOREIGN KEY FK_E5A029901259C1FF');
        $this->addSql('ALTER TABLE day DROP FOREIGN KEY FK_E5A029904AA53143');
        $this->addSql('DROP INDEX IDX_E5A029901259C1FF ON day');
        $this->addSql('DROP INDEX IDX_E5A029904AA53143 ON day');
        $this->addSql('ALTER TABLE day DROP statuses_id, DROP pers_id');
    }
}
