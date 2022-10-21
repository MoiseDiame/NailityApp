<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221016092559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD vsp_color_id INT DEFAULT NULL, DROP color');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD93381D6A FOREIGN KEY (vsp_color_id) REFERENCES vsp_color (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD93381D6A ON product (vsp_color_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD93381D6A');
        $this->addSql('DROP INDEX IDX_D34A04AD93381D6A ON product');
        $this->addSql('ALTER TABLE product ADD color VARCHAR(255) DEFAULT NULL, DROP vsp_color_id');
    }
}
