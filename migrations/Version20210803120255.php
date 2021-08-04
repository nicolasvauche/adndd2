<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210803120255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_tribe (game_id INT NOT NULL, tribe_id INT NOT NULL, INDEX IDX_1460CCD7E48FD905 (game_id), INDEX IDX_1460CCD76F3EE0AD (tribe_id), PRIMARY KEY(game_id, tribe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tribe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_tribe ADD CONSTRAINT FK_1460CCD7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_tribe ADD CONSTRAINT FK_1460CCD76F3EE0AD FOREIGN KEY (tribe_id) REFERENCES tribe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_tribe DROP FOREIGN KEY FK_1460CCD76F3EE0AD');
        $this->addSql('DROP TABLE game_tribe');
        $this->addSql('DROP TABLE tribe');
    }
}
