<?php

namespace WebGroc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170617222056 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE groc_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE groc_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE groc_item (id INT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_47FC8DCE5E237E06 ON groc_item (name)');
        $this->addSql('CREATE TABLE groc_list (id INT NOT NULL, week_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE groc_list_groc_item (list_id INT NOT NULL, item_id INT NOT NULL, PRIMARY KEY(list_id, item_id))');
        $this->addSql('CREATE INDEX IDX_9372A5B03DAE168B ON groc_list_groc_item (list_id)');
        $this->addSql('CREATE INDEX IDX_9372A5B0126F525E ON groc_list_groc_item (item_id)');
        $this->addSql('ALTER TABLE groc_list_groc_item ADD CONSTRAINT FK_9372A5B03DAE168B FOREIGN KEY (list_id) REFERENCES groc_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groc_list_groc_item ADD CONSTRAINT FK_9372A5B0126F525E FOREIGN KEY (item_id) REFERENCES groc_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

//        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE groc_list_groc_item DROP CONSTRAINT FK_9372A5B0126F525E');
        $this->addSql('ALTER TABLE groc_list_groc_item DROP CONSTRAINT FK_9372A5B03DAE168B');
        $this->addSql('DROP SEQUENCE groc_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE groc_list_id_seq CASCADE');
        $this->addSql('DROP TABLE groc_item');
        $this->addSql('DROP TABLE groc_list');
        $this->addSql('DROP TABLE groc_list_groc_item');
    }
}
