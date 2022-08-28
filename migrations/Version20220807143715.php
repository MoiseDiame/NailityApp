<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220807143715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_availablity (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vsp (id INT AUTO_INCREMENT NOT NULL, color_id INT NOT NULL, availablity_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, weight VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, new TINYINT(1) DEFAULT NULL, created_at DATE NOT NULL, presentation_picture LONGBLOB NOT NULL, others_pictures LONGBLOB DEFAULT NULL, INDEX IDX_FB2A96F97ADA1FB5 (color_id), INDEX IDX_FB2A96F9B09327FC (availablity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vsp_vsp_conditioning (vsp_id INT NOT NULL, vsp_conditioning_id INT NOT NULL, INDEX IDX_801E114420F469DE (vsp_id), INDEX IDX_801E1144A809A5B8 (vsp_conditioning_id), PRIMARY KEY(vsp_id, vsp_conditioning_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vsp_color (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vsp_conditioning (id INT AUTO_INCREMENT NOT NULL, conditioning VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F97ADA1FB5 FOREIGN KEY (color_id) REFERENCES vsp_color (id)');
        $this->addSql('ALTER TABLE vsp ADD CONSTRAINT FK_FB2A96F9B09327FC FOREIGN KEY (availablity_id) REFERENCES product_availablity (id)');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning ADD CONSTRAINT FK_801E114420F469DE FOREIGN KEY (vsp_id) REFERENCES vsp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning ADD CONSTRAINT FK_801E1144A809A5B8 FOREIGN KEY (vsp_conditioning_id) REFERENCES vsp_conditioning (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vsp DROP FOREIGN KEY FK_FB2A96F9B09327FC');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning DROP FOREIGN KEY FK_801E114420F469DE');
        $this->addSql('ALTER TABLE vsp DROP FOREIGN KEY FK_FB2A96F97ADA1FB5');
        $this->addSql('ALTER TABLE vsp_vsp_conditioning DROP FOREIGN KEY FK_801E1144A809A5B8');
        $this->addSql('DROP TABLE product_availablity');
        $this->addSql('DROP TABLE vsp');
        $this->addSql('DROP TABLE vsp_vsp_conditioning');
        $this->addSql('DROP TABLE vsp_color');
        $this->addSql('DROP TABLE vsp_conditioning');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
