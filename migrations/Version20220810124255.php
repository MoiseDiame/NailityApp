<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220810124255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vsp_vsp_conditioning DROP FOREIGN KEY FK_801E1144A809A5B8');
        $this->addSql('DROP TABLE vsp_conditioning');
        $this->addSql('DROP TABLE vsp_vsp_conditioning');
        $this->addSql('ALTER TABLE vsp ADD size VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_conditioning (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vsp_vsp_conditioning (vsp_id INT NOT NULL, vsp_conditioning_id INT NOT NULL, INDEX IDX_801E114420F469DE (vsp_id), INDEX IDX_801E1144A809A5B8 (vsp_conditioning_id), PRIMARY KEY(vsp_id, vsp_conditioning_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning ADD CONSTRAINT FK_801E114420F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning ADD CONSTRAINT FK_801E1144A809A5B8 FOREIGN KEY (vsp_conditioning_id) REFERENCES vsp_conditioning (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp DROP size');
    }
}
