<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180809114538 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_7510A3CF5A91C08D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__funcionario AS SELECT id, departamento_id, nome, email, senha FROM funcionario');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('CREATE TABLE funcionario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, departamento_id INTEGER DEFAULT NULL, nome VARCHAR(200) NOT NULL COLLATE BINARY, email VARCHAR(150) DEFAULT NULL COLLATE BINARY, senha VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_7510A3CF5A91C08D FOREIGN KEY (departamento_id) REFERENCES departamento (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO funcionario (id, departamento_id, nome, email, senha) SELECT id, departamento_id, nome, email, senha FROM __temp__funcionario');
        $this->addSql('DROP TABLE __temp__funcionario');
        $this->addSql('CREATE INDEX IDX_7510A3CF5A91C08D ON funcionario (departamento_id)');
        $this->addSql('DROP INDEX IDX_C1BF366A642FEB76');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movimentacao AS SELECT id, funcionario_id, descricao, valor FROM movimentacao');
        $this->addSql('DROP TABLE movimentacao');
        $this->addSql('CREATE TABLE movimentacao (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, funcionario_id INTEGER NOT NULL, descricao VARCHAR(250) NOT NULL COLLATE BINARY, valor NUMERIC(10, 2) NOT NULL, data DATETIME NOT NULL, fornecedor VARCHAR(200) NOT NULL, CONSTRAINT FK_C1BF366A642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO movimentacao (id, funcionario_id, descricao, valor) SELECT id, funcionario_id, descricao, valor FROM __temp__movimentacao');
        $this->addSql('DROP TABLE __temp__movimentacao');
        $this->addSql('CREATE INDEX IDX_C1BF366A642FEB76 ON movimentacao (funcionario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_7510A3CF5A91C08D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__funcionario AS SELECT id, departamento_id, nome, email, senha FROM funcionario');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('CREATE TABLE funcionario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, departamento_id INTEGER DEFAULT NULL, nome VARCHAR(200) NOT NULL, email VARCHAR(150) DEFAULT NULL, senha VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO funcionario (id, departamento_id, nome, email, senha) SELECT id, departamento_id, nome, email, senha FROM __temp__funcionario');
        $this->addSql('DROP TABLE __temp__funcionario');
        $this->addSql('CREATE INDEX IDX_7510A3CF5A91C08D ON funcionario (departamento_id)');
        $this->addSql('DROP INDEX IDX_C1BF366A642FEB76');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movimentacao AS SELECT id, funcionario_id, descricao, valor FROM movimentacao');
        $this->addSql('DROP TABLE movimentacao');
        $this->addSql('CREATE TABLE movimentacao (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, funcionario_id INTEGER NOT NULL, descricao VARCHAR(250) NOT NULL, valor NUMERIC(10, 2) NOT NULL)');
        $this->addSql('INSERT INTO movimentacao (id, funcionario_id, descricao, valor) SELECT id, funcionario_id, descricao, valor FROM __temp__movimentacao');
        $this->addSql('DROP TABLE __temp__movimentacao');
        $this->addSql('CREATE INDEX IDX_C1BF366A642FEB76 ON movimentacao (funcionario_id)');
    }
}
