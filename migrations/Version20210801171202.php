<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210801171202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characteristic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_522FA9503EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_characteristic (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, characteristic_id INT DEFAULT NULL, base INT DEFAULT NULL, INDEX IDX_88E5F51CE48FD905 (game_id), INDEX IDX_88E5F51CDEE9D12B (characteristic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_characteristic ADD CONSTRAINT FK_88E5F51CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_characteristic ADD CONSTRAINT FK_88E5F51CDEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_characteristic DROP FOREIGN KEY FK_88E5F51CDEE9D12B');
        $this->addSql('DROP TABLE characteristic');
        $this->addSql('DROP TABLE game_characteristic');
    }
}
