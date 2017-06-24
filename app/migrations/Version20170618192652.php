<?php

namespace WebGroc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170618192652 extends AbstractMigration {
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE groc_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE groc_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D439FFF95E237E06 ON groc_type (name)');
        $this->addSql('ALTER TABLE groc_item ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groc_item ADD CONSTRAINT FK_47FC8DCEC54C8C93 FOREIGN KEY (type_id) REFERENCES groc_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_47FC8DCEC54C8C93 ON groc_item (type_id)');
        $this->addSql("INSERT INTO groc_type VALUES (nextval('groc_type_id_seq'),'Grocery')");
        $this->addSql("INSERT INTO groc_type VALUES (nextval('groc_type_id_seq'),'Produce')");
        $this->addSql("INSERT INTO groc_type VALUES (nextval('groc_type_id_seq'),'Dairy')");
        $this->addSql("INSERT INTO groc_type VALUES (nextval('groc_type_id_seq'),'Frozen')");
        $this->addSql("INSERT INTO groc_type VALUES (nextval('groc_type_id_seq'),'Meat')");
        $this->addSql("INSERT INTO groc_type VALUES (nextval('groc_type_id_seq'),'Bakery')");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE groc_item DROP CONSTRAINT FK_47FC8DCEC54C8C93');
        $this->addSql('DROP SEQUENCE groc_type_id_seq CASCADE');
        $this->addSql('DROP TABLE groc_type');
        $this->addSql('DROP INDEX IDX_47FC8DCEC54C8C93');
        $this->addSql('ALTER TABLE groc_item DROP type_id');
    }
}
