<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210804163137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, game_id INT DEFAULT NULL, tribe_id INT DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, guiding_hand VARCHAR(255) DEFAULT NULL, size VARCHAR(255) NOT NULL, weight VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, age INT DEFAULT NULL, distinctive LONGTEXT DEFAULT NULL, occupation VARCHAR(255) DEFAULT NULL, story LONGTEXT DEFAULT NULL, notes LONGTEXT DEFAULT NULL, is_premade TINYINT(1) NOT NULL, birthplace VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, homeplace VARCHAR(255) DEFAULT NULL, relatives VARCHAR(255) DEFAULT NULL, allegiance VARCHAR(255) DEFAULT NULL, coinpurse INT DEFAULT NULL, INDEX IDX_937AB034A76ED395 (user_id), INDEX IDX_937AB034E48FD905 (game_id), INDEX IDX_937AB0346F3EE0AD (tribe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0346F3EE0AD FOREIGN KEY (tribe_id) REFERENCES tribe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `character`');
    }
}
