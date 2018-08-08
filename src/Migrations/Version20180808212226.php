<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808212226 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE funcionario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, departamento_id INTEGER DEFAULT NULL, nome VARCHAR(200) NOT NULL, email VARCHAR(150) DEFAULT NULL, senha VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_7510A3CF5A91C08D ON funcionario (departamento_id)');
        $this->addSql('CREATE TABLE departamento (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, descricao VARCHAR(200) DEFAULT NULL)');
        $this->addSql('CREATE TABLE movimentacao (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, funcionario_id INTEGER NOT NULL, descricao VARCHAR(250) NOT NULL, valor NUMERIC(10, 2) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C1BF366A642FEB76 ON movimentacao (funcionario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE departamento');
        $this->addSql('DROP TABLE movimentacao');
    }
}
