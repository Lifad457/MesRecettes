<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181012085806 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etape ADD descritpion LONGTEXT NOT NULL, DROP description');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78703E2ED6D6');
        $this->addSql('DROP INDEX IDX_6BAF78703E2ED6D6 ON ingredient');
        $this->addSql('ALTER TABLE ingredient CHANGE recettes_id recette_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787089312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_6BAF787089312FE9 ON ingredient (recette_id)');
        $this->addSql('ALTER TABLE recette DROP description, CHANGE note note VARCHAR(255) NOT NULL, CHANGE difficulte difficulte VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etape ADD description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP descritpion');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787089312FE9');
        $this->addSql('DROP INDEX IDX_6BAF787089312FE9 ON ingredient');
        $this->addSql('ALTER TABLE ingredient CHANGE recette_id recettes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78703E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_6BAF78703E2ED6D6 ON ingredient (recettes_id)');
        $this->addSql('ALTER TABLE recette ADD description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE difficulte difficulte INT NOT NULL, CHANGE note note INT NOT NULL');
    }
}
