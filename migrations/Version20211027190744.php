<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027190744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD dob DATE NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, DROP address, CHANGE name name VARCHAR(80) NOT NULL, CHANGE email nationality VARCHAR(255) NOT NULL, CHANGE age phone INT NOT NULL');
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF392642B8210');
        $this->addSql('DROP INDEX IDX_426EF392642B8210 ON staff');
        $this->addSql('ALTER TABLE staff ADD dob DATE NOT NULL, ADD nationality VARCHAR(255) NOT NULL, DROP age, DROP address, CHANGE name name VARCHAR(80) NOT NULL, CHANGE admin_id admstaff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392E792B249 FOREIGN KEY (admstaff_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_426EF392E792B249 ON staff (admstaff_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD address VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP dob, DROP avatar, CHANGE name name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone age INT NOT NULL, CHANGE nationality email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE staff DROP FOREIGN KEY FK_426EF392E792B249');
        $this->addSql('DROP INDEX IDX_426EF392E792B249 ON staff');
        $this->addSql('ALTER TABLE staff ADD age INT NOT NULL, ADD address VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP dob, DROP nationality, CHANGE name name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE admstaff_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_426EF392642B8210 ON staff (admin_id)');
    }
}
