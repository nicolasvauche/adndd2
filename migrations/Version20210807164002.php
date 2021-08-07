<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210807164002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scenario_character (scenario_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_81E6D42E04E49DF (scenario_id), INDEX IDX_81E6D421136BE75 (character_id), PRIMARY KEY(scenario_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scenario_character ADD CONSTRAINT FK_81E6D42E04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scenario_character ADD CONSTRAINT FK_81E6D421136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE scenario_character');
    }
}
