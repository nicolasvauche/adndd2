<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210807204452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment_character (equipment_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_4147F64D517FE9FE (equipment_id), INDEX IDX_4147F64D1136BE75 (character_id), PRIMARY KEY(equipment_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipment_character ADD CONSTRAINT FK_4147F64D517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_character ADD CONSTRAINT FK_4147F64D1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_skill RENAME INDEX idx_a0fe031534e9e260 TO IDX_A0FE03151136BE75');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE equipment_character');
        $this->addSql('ALTER TABLE character_skill RENAME INDEX idx_a0fe03151136be75 TO IDX_A0FE031534E9E260');
    }
}
