<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210801160706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_skill (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, skill_id INT NOT NULL, base VARCHAR(255) DEFAULT NULL, INDEX IDX_6C0E9DF8E48FD905 (game_id), INDEX IDX_6C0E9DF85585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_skill ADD CONSTRAINT FK_6C0E9DF8E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_skill ADD CONSTRAINT FK_6C0E9DF85585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE game_skill');
    }
}
