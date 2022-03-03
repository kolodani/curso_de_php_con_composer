<?php
declare(strict_types=1);
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Migrations\AbortMigrationException;

class Version20200307122055 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Add parent field to tag model';
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws AbortMigrationException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up(Schema $schema): void
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on "postgresql".');

        $this->addSql('ALTER TABLE neos_media_domain_model_tag ADD parent VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE neos_media_domain_model_tag ADD CONSTRAINT FK_CA4889693D8E604F FOREIGN KEY (parent) REFERENCES neos_media_domain_model_tag (persistence_object_identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CA4889693D8E604F ON neos_media_domain_model_tag (parent)');
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws AbortMigrationException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function down(Schema $schema): void
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on "postgresql".');
        $this->addSql('ALTER TABLE neos_media_domain_model_tag DROP CONSTRAINT FK_CA4889693D8E604F');
        $this->addSql('DROP INDEX IDX_CA4889693D8E604F');
        $this->addSql('ALTER TABLE neos_media_domain_model_tag DROP parent');

    }
}
