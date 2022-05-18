<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518080033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE music_dislike (id INT AUTO_INCREMENT NOT NULL, music_disliked_id INT DEFAULT NULL, user_who_dislike_music_id INT DEFAULT NULL, INDEX IDX_3ACF7ED146E92AFF (music_disliked_id), INDEX IDX_3ACF7ED1BB97953F (user_who_dislike_music_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE music_dislike ADD CONSTRAINT FK_3ACF7ED146E92AFF FOREIGN KEY (music_disliked_id) REFERENCES music (id)');
        $this->addSql('ALTER TABLE music_dislike ADD CONSTRAINT FK_3ACF7ED1BB97953F FOREIGN KEY (user_who_dislike_music_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE music_dislike');
    }
}
