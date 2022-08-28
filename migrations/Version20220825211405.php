<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825211405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vsp DROP FOREIGN KEY FK_FB2A96F9B45DC79E');
        $this->addSql('DROP TABLE vsp_other_images');
        $this->addSql('DROP TABLE vsp_presentation_image');
        $this->addSql('DROP INDEX IDX_FB2A96F9B45DC79E ON vsp');
        $this->addSql('ALTER TABLE vsp ADD presentation_picture VARCHAR(255) NOT NULL, ADD illustration_picture1 VARCHAR(255) DEFAULT NULL, ADD illustration_picture2 VARCHAR(255) DEFAULT NULL, DROP presentation_picture_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_other_images (id INT AUTO_INCREMENT NOT NULL, vsp_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_1934326120F469DE (vsp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vsp_presentation_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vsp_other_images ADD CONSTRAINT FK_1934326120F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE vsp ADD presentation_picture_id INT DEFAULT NULL, DROP presentation_picture, DROP illustration_picture1, DROP illustration_picture2');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F9B45DC79E FOREIGN KEY (presentation_picture_id) REFERENCES vsp_presentation_image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FB2A96F9B45DC79E ON vsp (presentation_picture_id)');
    }
}
