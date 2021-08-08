<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210806150923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill ADD skill_type_id INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477DFB912BA FOREIGN KEY (skill_type_id) REFERENCES skill_type (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477DFB912BA ON skill (skill_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477DFB912BA');
        $this->addSql('DROP INDEX IDX_5E3DE477DFB912BA ON skill');
        $this->addSql('ALTER TABLE skill DROP skill_type_id, DROP description');
    }
}
