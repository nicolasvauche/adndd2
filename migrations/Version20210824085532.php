<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824085532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scenario_character (id INT AUTO_INCREMENT NOT NULL, scenario_id INT NOT NULL, personnage_id INT NOT NULL, is_accepted TINYINT(1) NOT NULL, INDEX IDX_81E6D42E04E49DF (scenario_id), INDEX IDX_81E6D425E315342 (personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scenario_character ADD CONSTRAINT FK_81E6D42E04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id)');
        $this->addSql('ALTER TABLE scenario_character ADD CONSTRAINT FK_81E6D425E315342 FOREIGN KEY (personnage_id) REFERENCES `character` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE scenario_character');
    }
}
