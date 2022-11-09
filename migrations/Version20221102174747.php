<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102174747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp (id INT AUTO_INCREMENT NOT NULL, availablity_id INT DEFAULT NULL, color_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, new TINYINT(1) DEFAULT NULL, created_at DATE NOT NULL, slug VARCHAR(255) NOT NULL, presentation_picture VARCHAR(255) NOT NULL, illustration_picture1 VARCHAR(255) DEFAULT NULL, illustration_picture2 VARCHAR(255) DEFAULT NULL, INDEX IDX_FB2A96F9B09327FC (availablity_id), INDEX IDX_FB2A96F97ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F9B09327FC FOREIGN KEY (availablity_id) REFERENCES product_availablity (id)');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F97ADA1FB5 FOREIGN KEY (color_id) REFERENCES vsp_color (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vsp');
    }
}
