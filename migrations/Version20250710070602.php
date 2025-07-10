<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250710070602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alerte (id INT AUTO_INCREMENT NOT NULL, monitoring_id INT DEFAULT NULL, message LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, datetime DATETIME NOT NULL, INDEX IDX_3AE753ADA4638B5 (monitoring_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_presence (id INT AUTO_INCREMENT NOT NULL, session_id INT DEFAULT NULL, stagiaire_id INT DEFAULT NULL, presence TINYINT(1) NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_F69FD34613FECDF (session_id), INDEX IDX_F69FD34BBA93DD6 (stagiaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, cv LONGTEXT NOT NULL, note DOUBLE PRECISION NOT NULL, est_valide TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, duree INT NOT NULL, prerequis LONGTEXT NOT NULL, diplome_obtenu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_theme (formation_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_E1FE797D5200282E (formation_id), INDEX IDX_E1FE797D59027487 (theme_id), PRIMARY KEY(formation_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, stagiaire_id INT DEFAULT NULL, session_id INT DEFAULT NULL, entreprise VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_5E90F6D6BBA93DD6 (stagiaire_id), INDEX IDX_5E90F6D6613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monitoring (id INT AUTO_INCREMENT NOT NULL, session_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_BA4F975D613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, role_responsable VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, formateur_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, lieu VARCHAR(255) NOT NULL, nombre_min_participants INT NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_D044D5D45200282E (formation_id), INDEX IDX_D044D5D4155D8F51 (formateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_theme (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E891E7ED59027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stagiaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_prerequis (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, questions JSON NOT NULL, UNIQUE INDEX UNIQ_487E7CC35200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alerte ADD CONSTRAINT FK_3AE753ADA4638B5 FOREIGN KEY (monitoring_id) REFERENCES monitoring (id)');
        $this->addSql('ALTER TABLE fiche_presence ADD CONSTRAINT FK_F69FD34613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE fiche_presence ADD CONSTRAINT FK_F69FD34BBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id)');
        $this->addSql('ALTER TABLE formation_theme ADD CONSTRAINT FK_E1FE797D5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_theme ADD CONSTRAINT FK_E1FE797D59027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6BBA93DD6 FOREIGN KEY (stagiaire_id) REFERENCES stagiaire (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE monitoring ADD CONSTRAINT FK_BA4F975D613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D45200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE sous_theme ADD CONSTRAINT FK_E891E7ED59027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE test_prerequis ADD CONSTRAINT FK_487E7CC35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alerte DROP FOREIGN KEY FK_3AE753ADA4638B5');
        $this->addSql('ALTER TABLE fiche_presence DROP FOREIGN KEY FK_F69FD34613FECDF');
        $this->addSql('ALTER TABLE fiche_presence DROP FOREIGN KEY FK_F69FD34BBA93DD6');
        $this->addSql('ALTER TABLE formation_theme DROP FOREIGN KEY FK_E1FE797D5200282E');
        $this->addSql('ALTER TABLE formation_theme DROP FOREIGN KEY FK_E1FE797D59027487');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6BBA93DD6');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6613FECDF');
        $this->addSql('ALTER TABLE monitoring DROP FOREIGN KEY FK_BA4F975D613FECDF');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D45200282E');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4155D8F51');
        $this->addSql('ALTER TABLE sous_theme DROP FOREIGN KEY FK_E891E7ED59027487');
        $this->addSql('ALTER TABLE test_prerequis DROP FOREIGN KEY FK_487E7CC35200282E');
        $this->addSql('DROP TABLE alerte');
        $this->addSql('DROP TABLE fiche_presence');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_theme');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE monitoring');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE sous_theme');
        $this->addSql('DROP TABLE stagiaire');
        $this->addSql('DROP TABLE test_prerequis');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
