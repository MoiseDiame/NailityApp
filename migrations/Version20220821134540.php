<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220821134540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vsp_vsp_other_images');
        $this->addSql('ALTER TABLE vsp DROP weight, DROP price, DROP size');
        $this->addSql('ALTER TABLE vsp_other_images ADD vsp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vsp_other_images ADD CONSTRAINT FK_1934326120F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id)');
        $this->addSql('CREATE INDEX IDX_1934326120F469DE ON vsp_other_images (vsp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_vsp_other_images (vsp_id INT NOT NULL, vsp_other_images_id INT NOT NULL, INDEX IDX_2FDE58DF20F469DE (vsp_id), INDEX IDX_2FDE58DFE390C4FA (vsp_other_images_id), PRIMARY KEY(vsp_id, vsp_other_images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vsp_vsp_other_images ADD CONSTRAINT FK_2FDE58DF20F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp_vsp_other_images ADD CONSTRAINT FK_2FDE58DFE390C4FA FOREIGN KEY (vsp_other_images_id) REFERENCES vsp_other_images (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp ADD weight VARCHAR(255) NOT NULL, ADD price VARCHAR(255) NOT NULL, ADD size VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vsp_other_images DROP FOREIGN KEY FK_1934326120F469DE');
        $this->addSql('DROP INDEX IDX_1934326120F469DE ON vsp_other_images');
        $this->addSql('ALTER TABLE vsp_other_images DROP vsp_id');
    }
}
