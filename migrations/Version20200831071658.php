<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831071658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, challenge_name VARCHAR(255) NOT NULL, challenge_position JSON NOT NULL, created_at DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, updated_by VARCHAR(255) NOT NULL, INDEX IDX_D7098951A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, challenge_id INT DEFAULT NULL, item_name VARCHAR(255) NOT NULL, item_position JSON NOT NULL, description VARCHAR(500) NOT NULL, item_level INT NOT NULL, created_at DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, updated_by VARCHAR(255) NOT NULL, INDEX IDX_1F1B251EA76ED395 (user_id), INDEX IDX_1F1B251E98A21AC6 (challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE success (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, success_name VARCHAR(255) NOT NULL, logo VARCHAR(500) NOT NULL, success_level INT NOT NULL, created_at DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, updated_by VARCHAR(255) NOT NULL, INDEX IDX_6F00DFB2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(500) DEFAULT NULL, roles JSON NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, updated_by VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E98A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id)');
        $this->addSql('ALTER TABLE success ADD CONSTRAINT FK_6F00DFB2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E98A21AC6');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951A76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA76ED395');
        $this->addSql('ALTER TABLE success DROP FOREIGN KEY FK_6F00DFB2A76ED395');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE success');
        $this->addSql('DROP TABLE user');
    }
}
