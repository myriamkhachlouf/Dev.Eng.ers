<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210324143726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7253258F FOREIGN KEY (postedby_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE evenement ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1038D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE formation CHANGE formateur_id formateur_id INT NOT NULL, CHANGE idevenement_id idevenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF497F501A FOREIGN KEY (idevenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE grille_evaluation ADD CONSTRAINT FK_6F6D9C56548DCEA2 FOREIGN KEY (entretien_id) REFERENCES entretien (id)');
        $this->addSql('ALTER TABLE offre CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67797253258F FOREIGN KEY (postedby_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7253258F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC38B217A7');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F8D0EB82');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA4CC8505A');
        $this->addSql('ALTER TABLE evenement DROP date');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1038D0EB82');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA4AEAFEA');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF155D8F51');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF497F501A');
        $this->addSql('ALTER TABLE formation CHANGE formateur_id formateur_id INT DEFAULT NULL, CHANGE idevenement_id idevenement_id INT NOT NULL');
        $this->addSql('ALTER TABLE grille_evaluation DROP FOREIGN KEY FK_6F6D9C56548DCEA2');
        $this->addSql('ALTER TABLE offre CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67797253258F');
    }
}
