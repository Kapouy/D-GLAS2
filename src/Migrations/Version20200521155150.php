<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521155150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etat_jeu (id INT AUTO_INCREMENT NOT NULL, jeu_id INT NOT NULL, nommenclature_etat_id INT NOT NULL, inventaire_id INT DEFAULT NULL, date DATETIME NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, jouable TINYINT(1) NOT NULL, piecesManquantes TINYINT(1) NOT NULL, flagInventaire TINYINT(1) NOT NULL, INDEX IDX_C43F542D8C9E392E (jeu_id), INDEX IDX_C43F542D27DB3E2 (nommenclature_etat_id), INDEX IDX_C43F542DCE430A85 (inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestionaire_jeu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_42A8195A6C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_338920E0AA9E377A (date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu (id INT AUTO_INCREMENT NOT NULL, nommenclature_jeu_id INT NOT NULL, proprietaire_id INT NOT NULL, idPhysique INT NOT NULL, INDEX IDX_82E48DB5AF521067 (nommenclature_jeu_id), INDEX IDX_82E48DB576C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, lieu_parent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, jeuUtilisable TINYINT(1) NOT NULL, inventoriable TINYINT(1) NOT NULL, defaut TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2F577D596C6E55B5 (nom), INDEX IDX_2F577D591D1D51C7 (lieu_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement_jeu (id INT AUTO_INCREMENT NOT NULL, gestionnaire_jeu_id INT NOT NULL, destination_id INT NOT NULL, dateMouvement DATETIME NOT NULL, dateRetourPrevu DATETIME DEFAULT NULL, commentaire VARCHAR(500) DEFAULT NULL, INDEX IDX_3CBC7500DB63970 (gestionnaire_jeu_id), INDEX IDX_3CBC7500816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouvement_jeu_jeu (mouvement_jeu_id INT NOT NULL, jeu_id INT NOT NULL, INDEX IDX_FAAAA3C7F6DEB718 (mouvement_jeu_id), INDEX IDX_FAAAA3C78C9E392E (jeu_id), PRIMARY KEY(mouvement_jeu_id, jeu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nommenclature_etat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, ordre INT NOT NULL, inventoriable TINYINT(1) NOT NULL, valide TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C111493F6C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nommenclature_jeu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3D61543C6C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_69E399D66C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etat_jeu ADD CONSTRAINT FK_C43F542D8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id)');
        $this->addSql('ALTER TABLE etat_jeu ADD CONSTRAINT FK_C43F542D27DB3E2 FOREIGN KEY (nommenclature_etat_id) REFERENCES nommenclature_etat (id)');
        $this->addSql('ALTER TABLE etat_jeu ADD CONSTRAINT FK_C43F542DCE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_82E48DB5AF521067 FOREIGN KEY (nommenclature_jeu_id) REFERENCES nommenclature_jeu (id)');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_82E48DB576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D591D1D51C7 FOREIGN KEY (lieu_parent_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE mouvement_jeu ADD CONSTRAINT FK_3CBC7500DB63970 FOREIGN KEY (gestionnaire_jeu_id) REFERENCES gestionaire_jeu (id)');
        $this->addSql('ALTER TABLE mouvement_jeu ADD CONSTRAINT FK_3CBC7500816C6140 FOREIGN KEY (destination_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE mouvement_jeu_jeu ADD CONSTRAINT FK_FAAAA3C7F6DEB718 FOREIGN KEY (mouvement_jeu_id) REFERENCES mouvement_jeu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mouvement_jeu_jeu ADD CONSTRAINT FK_FAAAA3C78C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mouvement_jeu DROP FOREIGN KEY FK_3CBC7500DB63970');
        $this->addSql('ALTER TABLE etat_jeu DROP FOREIGN KEY FK_C43F542DCE430A85');
        $this->addSql('ALTER TABLE etat_jeu DROP FOREIGN KEY FK_C43F542D8C9E392E');
        $this->addSql('ALTER TABLE mouvement_jeu_jeu DROP FOREIGN KEY FK_FAAAA3C78C9E392E');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D591D1D51C7');
        $this->addSql('ALTER TABLE mouvement_jeu DROP FOREIGN KEY FK_3CBC7500816C6140');
        $this->addSql('ALTER TABLE mouvement_jeu_jeu DROP FOREIGN KEY FK_FAAAA3C7F6DEB718');
        $this->addSql('ALTER TABLE etat_jeu DROP FOREIGN KEY FK_C43F542D27DB3E2');
        $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_82E48DB5AF521067');
        $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_82E48DB576C50E4A');
        $this->addSql('DROP TABLE etat_jeu');
        $this->addSql('DROP TABLE gestionaire_jeu');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE mouvement_jeu');
        $this->addSql('DROP TABLE mouvement_jeu_jeu');
        $this->addSql('DROP TABLE nommenclature_etat');
        $this->addSql('DROP TABLE nommenclature_jeu');
        $this->addSql('DROP TABLE proprietaire');
    }
}
