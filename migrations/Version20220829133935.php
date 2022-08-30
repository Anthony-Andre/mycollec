<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220829133935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collec (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_D8CCE934A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collec_video_game (collec_id INT NOT NULL, video_game_id INT NOT NULL, INDEX IDX_9FB81FF8584D4E9A (collec_id), INDEX IDX_9FB81FF816230A8 (video_game_id), PRIMARY KEY(collec_id, video_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE console (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_game (id INT AUTO_INCREMENT NOT NULL, console_id INT NOT NULL, name VARCHAR(255) NOT NULL, year INT NOT NULL, INDEX IDX_24BC6C5072F9DD9F (console_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collec ADD CONSTRAINT FK_D8CCE934A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collec_video_game ADD CONSTRAINT FK_9FB81FF8584D4E9A FOREIGN KEY (collec_id) REFERENCES collec (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collec_video_game ADD CONSTRAINT FK_9FB81FF816230A8 FOREIGN KEY (video_game_id) REFERENCES video_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C5072F9DD9F FOREIGN KEY (console_id) REFERENCES console (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collec DROP FOREIGN KEY FK_D8CCE934A76ED395');
        $this->addSql('ALTER TABLE collec_video_game DROP FOREIGN KEY FK_9FB81FF8584D4E9A');
        $this->addSql('ALTER TABLE collec_video_game DROP FOREIGN KEY FK_9FB81FF816230A8');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C5072F9DD9F');
        $this->addSql('DROP TABLE collec');
        $this->addSql('DROP TABLE collec_video_game');
        $this->addSql('DROP TABLE console');
        $this->addSql('DROP TABLE video_game');
    }
}
