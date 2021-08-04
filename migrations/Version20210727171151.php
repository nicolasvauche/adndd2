<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727171151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diceset (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diceset_dice (diceset_id INT NOT NULL, dice_id INT NOT NULL, INDEX IDX_6D79D89ED959322 (diceset_id), INDEX IDX_6D79D898604FF94 (dice_id), PRIMARY KEY(diceset_id, dice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diceset_dice ADD CONSTRAINT FK_6D79D89ED959322 FOREIGN KEY (diceset_id) REFERENCES diceset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diceset_dice ADD CONSTRAINT FK_6D79D898604FF94 FOREIGN KEY (dice_id) REFERENCES dice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_system ADD diceset_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game_system ADD CONSTRAINT FK_B478BC43ED959322 FOREIGN KEY (diceset_id) REFERENCES diceset (id)');
        $this->addSql('CREATE INDEX IDX_B478BC43ED959322 ON game_system (diceset_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diceset_dice DROP FOREIGN KEY FK_6D79D89ED959322');
        $this->addSql('ALTER TABLE game_system DROP FOREIGN KEY FK_B478BC43ED959322');
        $this->addSql('DROP TABLE diceset');
        $this->addSql('DROP TABLE diceset_dice');
        $this->addSql('DROP INDEX IDX_B478BC43ED959322 ON game_system');
        $this->addSql('ALTER TABLE game_system DROP diceset_id');
    }
}
