<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506074213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, name_music VARCHAR(255) NOT NULL, file_music VARCHAR(255) NOT NULL, picture_music VARCHAR(255) DEFAULT NULL, description_music LONGTEXT DEFAULT NULL, status_music INT NOT NULL, relaesedate_music DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nblike_music INT DEFAULT NULL, nblistened_music INT DEFAULT NULL, slug_music VARCHAR(255) NOT NULL, created_at_music DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at_music DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE music');
    }
}
