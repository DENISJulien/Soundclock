<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517134230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE banner (id INT AUTO_INCREMENT NOT NULL, name_banner VARCHAR(255) NOT NULL, status_banner INT NOT NULL, created_at_banner DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_banner DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name_genre VARCHAR(255) NOT NULL, picture_genre VARCHAR(255) DEFAULT NULL, description_genre LONGTEXT DEFAULT NULL, status_genre INT NOT NULL, slug_genre VARCHAR(255) NOT NULL, created_at_genre DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_genre DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, name_music VARCHAR(255) NOT NULL, file_music VARCHAR(255) NOT NULL, picture_music VARCHAR(255) DEFAULT NULL, description_music LONGTEXT DEFAULT NULL, status_music INT NOT NULL, releasedate_music DATE NOT NULL, nblike_music INT DEFAULT NULL, nblistened_music INT DEFAULT NULL, slug_music VARCHAR(255) NOT NULL, created_at_music DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_music DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_genre (music_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_E4D94830399BBB13 (music_id), INDEX IDX_E4D948304296D31F (genre_id), PRIMARY KEY(music_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_playlist (music_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_10914D0B399BBB13 (music_id), INDEX IDX_10914D0B6BBD148 (playlist_id), PRIMARY KEY(music_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_user (music_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D9A2D2D2399BBB13 (music_id), INDEX IDX_D9A2D2D2A76ED395 (user_id), PRIMARY KEY(music_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_like (id INT AUTO_INCREMENT NOT NULL, music_liked_id INT DEFAULT NULL, user_who_like_music_id INT DEFAULT NULL, INDEX IDX_F852442825FE445F (music_liked_id), INDEX IDX_F8524428CC7612DA (user_who_like_music_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name_playlist VARCHAR(255) NOT NULL, picture_playlist VARCHAR(255) DEFAULT NULL, description_playlist LONGTEXT DEFAULT NULL, album TINYINT(1) NOT NULL, status_playlist INT NOT NULL, nblike_playlist INT DEFAULT NULL, slug_playlist VARCHAR(255) NOT NULL, created_at_playlist DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_playlist DATETIME DEFAULT NULL, INDEX IDX_D782112DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, music_id INT DEFAULT NULL, user_id INT DEFAULT NULL, name_review VARCHAR(255) NOT NULL, content_review LONGTEXT NOT NULL, status_review INT NOT NULL, created_at_review DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_review DATETIME DEFAULT NULL, INDEX IDX_794381C6399BBB13 (music_id), INDEX IDX_794381C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name_user VARCHAR(255) NOT NULL, picture_user VARCHAR(255) DEFAULT NULL, description_user LONGTEXT DEFAULT NULL, certification_user TINYINT(1) NOT NULL, status_user INT NOT NULL, label_user VARCHAR(255) DEFAULT NULL, slug_user VARCHAR(255) NOT NULL, created_at_user DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_user DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE music_genre ADD CONSTRAINT FK_E4D94830399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_genre ADD CONSTRAINT FK_E4D948304296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_playlist ADD CONSTRAINT FK_10914D0B399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_playlist ADD CONSTRAINT FK_10914D0B6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_user ADD CONSTRAINT FK_D9A2D2D2399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_user ADD CONSTRAINT FK_D9A2D2D2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music_like ADD CONSTRAINT FK_F852442825FE445F FOREIGN KEY (music_liked_id) REFERENCES music (id)');
        $this->addSql('ALTER TABLE music_like ADD CONSTRAINT FK_F8524428CC7612DA FOREIGN KEY (user_who_like_music_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6399BBB13 FOREIGN KEY (music_id) REFERENCES music (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE music_genre DROP FOREIGN KEY FK_E4D948304296D31F');
        $this->addSql('ALTER TABLE music_genre DROP FOREIGN KEY FK_E4D94830399BBB13');
        $this->addSql('ALTER TABLE music_playlist DROP FOREIGN KEY FK_10914D0B399BBB13');
        $this->addSql('ALTER TABLE music_user DROP FOREIGN KEY FK_D9A2D2D2399BBB13');
        $this->addSql('ALTER TABLE music_like DROP FOREIGN KEY FK_F852442825FE445F');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6399BBB13');
        $this->addSql('ALTER TABLE music_playlist DROP FOREIGN KEY FK_10914D0B6BBD148');
        $this->addSql('ALTER TABLE music_user DROP FOREIGN KEY FK_D9A2D2D2A76ED395');
        $this->addSql('ALTER TABLE music_like DROP FOREIGN KEY FK_F8524428CC7612DA');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DA76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('DROP TABLE banner');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE music_genre');
        $this->addSql('DROP TABLE music_playlist');
        $this->addSql('DROP TABLE music_user');
        $this->addSql('DROP TABLE music_like');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE `user`');
    }
}
