<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810130014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vsp DROP FOREIGN KEY FK_FB2A96F9B45DC79E');
        $this->addSql('ALTER TABLE vsp_vsp_images DROP FOREIGN KEY FK_114D24A0C2CA28A2');
        $this->addSql('DROP TABLE vsp_images');
        $this->addSql('DROP TABLE vsp_vsp_images');
        $this->addSql('DROP INDEX UNIQ_FB2A96F9B45DC79E ON vsp');
        $this->addSql('ALTER TABLE vsp DROP presentation_picture_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_images (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vsp_vsp_images (vsp_id INT NOT NULL, vsp_images_id INT NOT NULL, INDEX IDX_114D24A020F469DE (vsp_id), INDEX IDX_114D24A0C2CA28A2 (vsp_images_id), PRIMARY KEY(vsp_id, vsp_images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vsp_vsp_images ADD CONSTRAINT FK_114D24A020F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp_vsp_images ADD CONSTRAINT FK_114D24A0C2CA28A2 FOREIGN KEY (vsp_images_id) REFERENCES vsp_images (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp ADD presentation_picture_id INT NOT NULL');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F9B45DC79E FOREIGN KEY (presentation_picture_id) REFERENCES vsp_images (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FB2A96F9B45DC79E ON vsp (presentation_picture_id)');
    }
}
