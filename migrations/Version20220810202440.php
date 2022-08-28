<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810202440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_other_images (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vsp DROP FOREIGN KEY vsp_ibfk_1');
        $this->addSql('DROP INDEX pictures ON vsp');
        $this->addSql('ALTER TABLE vsp DROP pictures');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vsp_other_images');
        $this->addSql('ALTER TABLE vsp ADD pictures INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT vsp_ibfk_1 FOREIGN KEY (pictures) REFERENCES vsp_images (id)');
        $this->addSql('CREATE INDEX pictures ON vsp (pictures)');
    }
}
