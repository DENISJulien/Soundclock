<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513134742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE music_listen (id INT AUTO_INCREMENT NOT NULL, music_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_57FCA404399BBB13 (music_id), INDEX IDX_57FCA404A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE music_listen ADD CONSTRAINT FK_57FCA404399BBB13 FOREIGN KEY (music_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE music_listen ADD CONSTRAINT FK_57FCA404A76ED395 FOREIGN KEY (user_id) REFERENCES music (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE music_listen');
    }
}
