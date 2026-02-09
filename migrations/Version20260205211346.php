<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260205211346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('ALTER TABLE categorie ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6347ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_497DD6347ECF78B0 ON categorie (cours_id)');
        $this->addSql('ALTER TABLE niveau ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36BB3E9C81 FOREIGN KEY (niveau_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_4BDFF36BB3E9C81 ON niveau (niveau_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cours');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6347ECF78B0');
        $this->addSql('DROP INDEX IDX_497DD6347ECF78B0 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP cours_id');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36BB3E9C81');
        $this->addSql('DROP INDEX IDX_4BDFF36BB3E9C81 ON niveau');
        $this->addSql('ALTER TABLE niveau DROP niveau_id');
    }
}
