<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617163709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pers (id INT AUTO_INCREMENT NOT NULL, fam VARCHAR(125) DEFAULT NULL, im VARCHAR(125) DEFAULT NULL, ot VARCHAR(125) DEFAULT NULL, passport_s VARCHAR(10) DEFAULT NULL, passport_n VARCHAR(24) DEFAULT NULL, passport_d VARCHAR(12) DEFAULT NULL, passport_by VARCHAR(255) DEFAULT NULL, dr DATE DEFAULT NULL, inn VARCHAR(55) NOT NULL, string VARCHAR(55) DEFAULT NULL, is_work TINYINT(1) NOT NULL, employee_num VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pers');
    }
}
