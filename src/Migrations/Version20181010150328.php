<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010150328 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, recette_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_285F75DD89312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, nom_ingredient VARCHAR(255) NOT NULL, quantite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, nom_recette VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, note INT NOT NULL, difficulte INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_ingredient (recette_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_17C041A989312FE9 (recette_id), INDEX IDX_17C041A9933FE08C (ingredient_id), PRIMARY KEY(recette_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD89312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_ingredient');
    }
}
