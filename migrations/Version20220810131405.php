<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810131405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vsp_vsp_other_pics DROP FOREIGN KEY FK_48A60F07F7CCBD0E');
        $this->addSql('ALTER TABLE vsp DROP FOREIGN KEY FK_FB2A96F93F660B14');
        $this->addSql('DROP TABLE vsp_other_pics');
        $this->addSql('DROP TABLE vsp_presentation_pics');
        $this->addSql('DROP TABLE vsp_vsp_other_pics');
        $this->addSql('DROP INDEX IDX_FB2A96F93F660B14 ON vsp');
        $this->addSql('ALTER TABLE vsp DROP presentation_pic_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_other_pics (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vsp_presentation_pics (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vsp_vsp_other_pics (vsp_id INT NOT NULL, vsp_other_pics_id INT NOT NULL, INDEX IDX_48A60F0720F469DE (vsp_id), INDEX IDX_48A60F07F7CCBD0E (vsp_other_pics_id), PRIMARY KEY(vsp_id, vsp_other_pics_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vsp_vsp_other_pics ADD CONSTRAINT FK_48A60F0720F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp_vsp_other_pics ADD CONSTRAINT FK_48A60F07F7CCBD0E FOREIGN KEY (vsp_other_pics_id) REFERENCES vsp_other_pics (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp ADD presentation_pic_id INT NOT NULL');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F93F660B14 FOREIGN KEY (presentation_pic_id) REFERENCES vsp_presentation_pics (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FB2A96F93F660B14 ON vsp (presentation_pic_id)');
    }
}
