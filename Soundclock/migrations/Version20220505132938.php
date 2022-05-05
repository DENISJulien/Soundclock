<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505132938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD name_user VARCHAR(255) NOT NULL, ADD picture_user VARCHAR(255) DEFAULT NULL, ADD description_user LONGTEXT DEFAULT NULL, ADD label_user VARCHAR(255) DEFAULT NULL, ADD slug_user VARCHAR(255) NOT NULL, DROP name, DROP picture, DROP description, DROP label, DROP slug, CHANGE certification certification_user TINYINT(1) NOT NULL, CHANGE status status_user INT NOT NULL, CHANGE created_at created_at_user DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at_user DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` ADD name VARCHAR(255) NOT NULL, ADD picture VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD label VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL, DROP name_user, DROP picture_user, DROP description_user, DROP label_user, DROP slug_user, CHANGE certification_user certification TINYINT(1) NOT NULL, CHANGE status_user status INT NOT NULL, CHANGE created_at_user created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at_user updated_at DATETIME DEFAULT NULL');
    }
}
