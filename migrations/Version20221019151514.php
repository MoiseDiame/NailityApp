<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221019151514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD vsp_size_id INT DEFAULT NULL, ADD vsp_price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC82A4221 FOREIGN KEY (vsp_size_id) REFERENCES vsp_size (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD3FF6C538 FOREIGN KEY (vsp_price_id) REFERENCES vsp_price (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC82A4221 ON product (vsp_size_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD3FF6C538 ON product (vsp_price_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC82A4221');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD3FF6C538');
        $this->addSql('DROP INDEX IDX_D34A04ADC82A4221 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD3FF6C538 ON product');
        $this->addSql('ALTER TABLE product DROP vsp_size_id, DROP vsp_price_id');
    }
}
