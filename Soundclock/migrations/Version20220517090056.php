<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517090056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE music_like ADD user_who_like_music_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE music_like ADD CONSTRAINT FK_F8524428CC7612DA FOREIGN KEY (user_who_like_music_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_F8524428CC7612DA ON music_like (user_who_like_music_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE music_like DROP FOREIGN KEY FK_F8524428CC7612DA');
        $this->addSql('DROP INDEX IDX_F8524428CC7612DA ON music_like');
        $this->addSql('ALTER TABLE music_like DROP user_who_like_music_id');
    }
}
