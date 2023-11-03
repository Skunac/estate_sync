<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103133155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advertisement (id INT AUTO_INCREMENT NOT NULL, good_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, price INT NOT NULL, address VARCHAR(255) NOT NULL, number_of_rooms INT DEFAULT NULL, number_of_bathrooms INT DEFAULT NULL, area INT NOT NULL, publication_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C95F6AEE1CF98C70 (good_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE good (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertisement ADD CONSTRAINT FK_C95F6AEE1CF98C70 FOREIGN KEY (good_id) REFERENCES good (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisement DROP FOREIGN KEY FK_C95F6AEE1CF98C70');
        $this->addSql('DROP TABLE advertisement');
        $this->addSql('DROP TABLE good');
    }
}
