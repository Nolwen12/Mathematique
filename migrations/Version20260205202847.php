<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260205202847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitre ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B025BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_8C62B025BCF5E72D ON chapitre (categorie_id)');
        $this->addSql('ALTER TABLE exercice ADD chapitre_id INT DEFAULT NULL, ADD correction_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D94AE086B FOREIGN KEY (correction_id) REFERENCES correction (id)');
        $this->addSql('CREATE INDEX IDX_E418C74D1FBEEF7B ON exercice (chapitre_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E418C74D94AE086B ON exercice (correction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B025BCF5E72D');
        $this->addSql('DROP INDEX IDX_8C62B025BCF5E72D ON chapitre');
        $this->addSql('ALTER TABLE chapitre DROP categorie_id');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D1FBEEF7B');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D94AE086B');
        $this->addSql('DROP INDEX IDX_E418C74D1FBEEF7B ON exercice');
        $this->addSql('DROP INDEX UNIQ_E418C74D94AE086B ON exercice');
        $this->addSql('ALTER TABLE exercice DROP chapitre_id, DROP correction_id');
    }
}
