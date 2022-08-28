<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808211037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vsp_vsp_conditioning (vsp_id INT NOT NULL, vsp_conditioning_id INT NOT NULL, INDEX IDX_801E114420F469DE (vsp_id), INDEX IDX_801E1144A809A5B8 (vsp_conditioning_id), PRIMARY KEY(vsp_id, vsp_conditioning_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning ADD CONSTRAINT FK_801E114420F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning ADD CONSTRAINT FK_801E1144A809A5B8 FOREIGN KEY (vsp_conditioning_id) REFERENCES vsp_conditioning (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vsp_vsp_conditioning');
    }
}
