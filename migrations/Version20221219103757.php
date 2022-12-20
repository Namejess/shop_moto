<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219103757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, numero INT NOT NULL, rue VARCHAR(255) NOT NULL, cp INT NOT NULL, ville VARCHAR(255) NOT NULL, complement VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_C35F081667B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, users_id INT DEFAULT NULL, adresse_facture_id INT DEFAULT NULL, adresse_livraison_id INT DEFAULT NULL, date_commande INT NOT NULL, total INT NOT NULL, payee TINYINT(1) NOT NULL, retrait VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_35D4282CF77D927C (panier_id), INDEX IDX_35D4282C67B3B43D (users_id), INDEX IDX_35D4282C10309E7F (adresse_facture_id), INDEX IDX_35D4282CBE2F0A35 (adresse_livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motos (id INT AUTO_INCREMENT NOT NULL, marques_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, kilometrage INT NOT NULL, prix INT NOT NULL, date_immat DATE NOT NULL, puissance INT NOT NULL, INDEX IDX_BC5434D6C256483C (marques_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, date_panier DATE NOT NULL, total INT NOT NULL, UNIQUE INDEX UNIQ_24CC0DF267B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, motos_id INT DEFAULT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_876E0D93869EA14 (motos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, roles VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081667B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C10309E7F FOREIGN KEY (adresse_facture_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CBE2F0A35 FOREIGN KEY (adresse_livraison_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE motos ADD CONSTRAINT FK_BC5434D6C256483C FOREIGN KEY (marques_id) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D93869EA14 FOREIGN KEY (motos_id) REFERENCES motos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081667B3B43D');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF77D927C');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C67B3B43D');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C10309E7F');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CBE2F0A35');
        $this->addSql('ALTER TABLE motos DROP FOREIGN KEY FK_BC5434D6C256483C');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF267B3B43D');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D93869EA14');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE motos');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
