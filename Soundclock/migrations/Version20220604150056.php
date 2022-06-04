<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604150056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE playlist_dislike (id INT AUTO_INCREMENT NOT NULL, playlist_disliked_id INT DEFAULT NULL, user_who_dislike_playlist_id INT DEFAULT NULL, INDEX IDX_4104FBB0CD54C5C3 (playlist_disliked_id), INDEX IDX_4104FBB0355D2B49 (user_who_dislike_playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_like (id INT AUTO_INCREMENT NOT NULL, playlist_liked_id INT DEFAULT NULL, user_who_like_playlist_id INT DEFAULT NULL, INDEX IDX_C7A77D11F30DE14 (playlist_liked_id), INDEX IDX_C7A77D139BBE517 (user_who_like_playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist_dislike ADD CONSTRAINT FK_4104FBB0CD54C5C3 FOREIGN KEY (playlist_disliked_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_dislike ADD CONSTRAINT FK_4104FBB0355D2B49 FOREIGN KEY (user_who_dislike_playlist_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_like ADD CONSTRAINT FK_C7A77D11F30DE14 FOREIGN KEY (playlist_liked_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_like ADD CONSTRAINT FK_C7A77D139BBE517 FOREIGN KEY (user_who_like_playlist_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE playlist_dislike');
        $this->addSql('DROP TABLE playlist_like');
    }
}
