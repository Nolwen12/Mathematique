<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260208094835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitre DROP sous_titre, CHANGE detail contenue VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE correction DROP question');
        $this->addSql('ALTER TABLE exercice CHANGE description contenue VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitre ADD sous_titre VARCHAR(255) DEFAULT NULL, CHANGE contenue detail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE correction ADD question VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE exercice CHANGE contenue description VARCHAR(255) NOT NULL');
    }
}
