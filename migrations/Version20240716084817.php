<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716084817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, relation_serveur_id INT DEFAULT NULL, relation_barman_id INT DEFAULT NULL, created_date DATETIME NOT NULL, number_table VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67D52E0BE80 (relation_serveur_id), INDEX IDX_6EEAA67D64762244 (relation_barman_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D52E0BE80 FOREIGN KEY (relation_serveur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D64762244 FOREIGN KEY (relation_barman_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE boisson ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84D82EA2E54 ON boisson (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84D82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D52E0BE80');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D64762244');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP INDEX IDX_8B97C84D82EA2E54 ON boisson');
        $this->addSql('ALTER TABLE boisson DROP commande_id');
    }
}
