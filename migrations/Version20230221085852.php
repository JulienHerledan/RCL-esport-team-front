<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221085852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_network_link (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, social_network_id INT NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_9152F3B97597D3FE (member_id), INDEX IDX_9152F3B9FA413953 (social_network_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social_network_link ADD CONSTRAINT FK_9152F3B97597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE social_network_link ADD CONSTRAINT FK_9152F3B9FA413953 FOREIGN KEY (social_network_id) REFERENCES social_network (id)');
        $this->addSql('ALTER TABLE social_network DROP FOREIGN KEY FK_EFFF52217597D3FE');
        $this->addSql('DROP INDEX IDX_EFFF52217597D3FE ON social_network');
        $this->addSql('ALTER TABLE social_network DROP member_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_network_link DROP FOREIGN KEY FK_9152F3B97597D3FE');
        $this->addSql('ALTER TABLE social_network_link DROP FOREIGN KEY FK_9152F3B9FA413953');
        $this->addSql('DROP TABLE social_network_link');
        $this->addSql('ALTER TABLE social_network ADD member_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF52217597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE INDEX IDX_EFFF52217597D3FE ON social_network (member_id)');
    }
}
