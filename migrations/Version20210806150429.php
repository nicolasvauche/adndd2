<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210806150429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_spell DROP FOREIGN KEY FK_2EFC2AEFC70F0E28');
        $this->addSql('DROP INDEX IDX_2EFC2AEFC70F0E28 ON character_spell');
        //$this->addSql('ALTER TABLE character_spell CHANGE characters_id character_id INT NOT NULL');
        $this->addSql('ALTER TABLE character_spell ADD CONSTRAINT FK_2EFC2AEF1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('CREATE INDEX IDX_2EFC2AEF1136BE75 ON character_spell (character_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE skill_type');
        $this->addSql('ALTER TABLE character_spell DROP FOREIGN KEY FK_2EFC2AEF1136BE75');
        $this->addSql('DROP INDEX IDX_2EFC2AEF1136BE75 ON character_spell');
        //$this->addSql('ALTER TABLE character_spell CHANGE character_id character_id INT NOT NULL');
        $this->addSql('ALTER TABLE character_spell ADD CONSTRAINT FK_2EFC2AEFC70F0E28 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('CREATE INDEX IDX_2EFC2AEFC70F0E28 ON character_spell (character_id)');
    }
}
