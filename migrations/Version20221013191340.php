<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013191340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE electric_devices ADD availablity_id INT DEFAULT NULL, ADD new TINYINT(1) NOT NULL, ADD created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE electric_devices ADD CONSTRAINT FK_DA5C13FBB09327FC FOREIGN KEY (availablity_id) REFERENCES product_availablity (id)');
        $this->addSql('CREATE INDEX IDX_DA5C13FBB09327FC ON electric_devices (availablity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE electric_devices DROP FOREIGN KEY FK_DA5C13FBB09327FC');
        $this->addSql('DROP INDEX IDX_DA5C13FBB09327FC ON electric_devices');
        $this->addSql('ALTER TABLE electric_devices DROP availablity_id, DROP new, DROP created_at');
    }
}
