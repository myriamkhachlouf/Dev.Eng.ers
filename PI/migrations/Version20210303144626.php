<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303144626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entretien (id INT AUTO_INCREMENT NOT NULL, cadidature_id INT NOT NULL, recruteur_id INT NOT NULL, date DATE NOT NULL, horaire TIME NOT NULL, lieu VARCHAR(255) NOT NULL, confirmation TINYINT(1) NOT NULL, etat TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2B58D6DA8AA9AA0E (cadidature_id), INDEX IDX_2B58D6DABB0859F1 (recruteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grille_evaluation (id INT AUTO_INCREMENT NOT NULL, entretien_id INT NOT NULL, commentaire VARCHAR(255) NOT NULL, admission TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_6F6D9C56548DCEA2 (entretien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, domaine VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA8AA9AA0E FOREIGN KEY (cadidature_id) REFERENCES candidature (id)');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DABB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id)');
        $this->addSql('ALTER TABLE grille_evaluation ADD CONSTRAINT FK_6F6D9C56548DCEA2 FOREIGN KEY (entretien_id) REFERENCES entretien (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grille_evaluation DROP FOREIGN KEY FK_6F6D9C56548DCEA2');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DABB0859F1');
        $this->addSql('DROP TABLE entretien');
        $this->addSql('DROP TABLE grille_evaluation');
        $this->addSql('DROP TABLE recruteur');
    }
}
