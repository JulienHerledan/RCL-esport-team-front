<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302085905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F20F699D9');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F20F699D9 FOREIGN KEY (accepted_by_id) REFERENCES `user` (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F20F699D9');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F20F699D9 FOREIGN KEY (accepted_by_id) REFERENCES user (id)');
    }
}
