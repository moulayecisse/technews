<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180703093238 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE newsletter (id INTEGER NOT NULL, email VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2');
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, category_id, user_id, title, content, featured_image, special, spotlight, created_date, slug FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER NOT NULL, category_id INTEGER NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, featured_image VARCHAR(180) NOT NULL COLLATE BINARY, special BOOLEAN NOT NULL, spotlight BOOLEAN NOT NULL, created_date DATETIME NOT NULL, slug VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, category_id, user_id, title, content, featured_image, special, spotlight, created_date, slug) SELECT id, category_id, user_id, title, content, featured_image, special, spotlight, created_date, slug FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2');
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, category_id, user_id, title, slug, content, featured_image, special, spotlight, created_date FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER NOT NULL, category_id INTEGER NOT NULL, user_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content CLOB NOT NULL, featured_image VARCHAR(180) NOT NULL, special BOOLEAN NOT NULL, spotlight BOOLEAN NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO article (id, category_id, user_id, title, slug, content, featured_image, special, spotlight, created_date) SELECT id, category_id, user_id, title, slug, content, featured_image, special, spotlight, created_date FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
    }
}
