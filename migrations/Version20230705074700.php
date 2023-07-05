<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230705074700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_game_genre (game_id INT NOT NULL, game_genre_id INT NOT NULL, INDEX IDX_5FBF8D9AE48FD905 (game_id), INDEX IDX_5FBF8D9AE9D22C39 (game_genre_id), PRIMARY KEY(game_id, game_genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_game_genre ADD CONSTRAINT FK_5FBF8D9AE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_game_genre ADD CONSTRAINT FK_5FBF8D9AE9D22C39 FOREIGN KEY (game_genre_id) REFERENCES game_genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_game_genre DROP FOREIGN KEY FK_5FBF8D9AE48FD905');
        $this->addSql('ALTER TABLE game_game_genre DROP FOREIGN KEY FK_5FBF8D9AE9D22C39');
        $this->addSql('DROP TABLE game_game_genre');
    }
}
