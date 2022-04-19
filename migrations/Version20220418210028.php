<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418210028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE materials_in_warehouse_articles');
        $this->addSql('DROP TABLE materials_in_warehouse_ware_houses');
        $this->addSql('ALTER TABLE articles CHANGE unit_short_name_id unit_short_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materials_in_warehouse ADD ware_house_id INT DEFAULT NULL, ADD article_id INT DEFAULT NULL, DROP amount, DROP unit_price, DROP vat');
        $this->addSql('ALTER TABLE materials_in_warehouse ADD CONSTRAINT FK_33ED9C9749FA2CE4 FOREIGN KEY (ware_house_id) REFERENCES ware_houses (id)');
        $this->addSql('ALTER TABLE materials_in_warehouse ADD CONSTRAINT FK_33ED9C977294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_33ED9C9749FA2CE4 ON materials_in_warehouse (ware_house_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33ED9C977294869C ON materials_in_warehouse (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE materials_in_warehouse_articles (materials_in_warehouse_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_A75F48951EBAF6CC (articles_id), INDEX IDX_A75F48959D5230A5 (materials_in_warehouse_id), PRIMARY KEY(materials_in_warehouse_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materials_in_warehouse_ware_houses (materials_in_warehouse_id INT NOT NULL, ware_houses_id INT NOT NULL, INDEX IDX_753AD140405F6168 (ware_houses_id), INDEX IDX_753AD1409D5230A5 (materials_in_warehouse_id), PRIMARY KEY(materials_in_warehouse_id, ware_houses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles ADD CONSTRAINT FK_A75F48951EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles ADD CONSTRAINT FK_A75F48959D5230A5 FOREIGN KEY (materials_in_warehouse_id) REFERENCES materials_in_warehouse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses ADD CONSTRAINT FK_753AD140405F6168 FOREIGN KEY (ware_houses_id) REFERENCES ware_houses (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses ADD CONSTRAINT FK_753AD1409D5230A5 FOREIGN KEY (materials_in_warehouse_id) REFERENCES materials_in_warehouse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles CHANGE unit_short_name_id unit_short_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE materials_in_warehouse DROP FOREIGN KEY FK_33ED9C9749FA2CE4');
        $this->addSql('ALTER TABLE materials_in_warehouse DROP FOREIGN KEY FK_33ED9C977294869C');
        $this->addSql('DROP INDEX IDX_33ED9C9749FA2CE4 ON materials_in_warehouse');
        $this->addSql('DROP INDEX UNIQ_33ED9C977294869C ON materials_in_warehouse');
        $this->addSql('ALTER TABLE materials_in_warehouse ADD amount INT NOT NULL, ADD unit_price DOUBLE PRECISION NOT NULL, ADD vat DOUBLE PRECISION NOT NULL, DROP ware_house_id, DROP article_id');
    }
}
