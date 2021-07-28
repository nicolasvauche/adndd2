<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728162043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spell (id INT AUTO_INCREMENT NOT NULL, spell_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, effect VARCHAR(255) NOT NULL, reach INT DEFAULT NULL, zone INT DEFAULT NULL, INDEX IDX_D03FCD8DA829C98F (spell_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE spell ADD CONSTRAINT FK_D03FCD8DA829C98F FOREIGN KEY (spell_type_id) REFERENCES spell_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE spell');
    }
}
