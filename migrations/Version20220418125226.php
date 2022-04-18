<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418125226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, unit_short_name_id INT NOT NULL, article_name VARCHAR(255) NOT NULL, INDEX IDX_BFDD3168B40FDB7B (unit_short_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materials_in_warehouse (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materials_in_warehouse_ware_houses (materials_in_warehouse_id INT NOT NULL, ware_houses_id INT NOT NULL, INDEX IDX_753AD1409D5230A5 (materials_in_warehouse_id), INDEX IDX_753AD140405F6168 (ware_houses_id), PRIMARY KEY(materials_in_warehouse_id, ware_houses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materials_in_warehouse_articles (materials_in_warehouse_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_A75F48959D5230A5 (materials_in_warehouse_id), INDEX IDX_A75F48951EBAF6CC (articles_id), PRIMARY KEY(materials_in_warehouse_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE units (id INT AUTO_INCREMENT NOT NULL, unit_short_name VARCHAR(255) NOT NULL, unit_long_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ware_houses (id INT AUTO_INCREMENT NOT NULL, ware_house_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168B40FDB7B FOREIGN KEY (unit_short_name_id) REFERENCES units (id)');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses ADD CONSTRAINT FK_753AD1409D5230A5 FOREIGN KEY (materials_in_warehouse_id) REFERENCES materials_in_warehouse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses ADD CONSTRAINT FK_753AD140405F6168 FOREIGN KEY (ware_houses_id) REFERENCES ware_houses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles ADD CONSTRAINT FK_A75F48959D5230A5 FOREIGN KEY (materials_in_warehouse_id) REFERENCES materials_in_warehouse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles ADD CONSTRAINT FK_A75F48951EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materials_in_warehouse_articles DROP FOREIGN KEY FK_A75F48951EBAF6CC');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses DROP FOREIGN KEY FK_753AD1409D5230A5');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles DROP FOREIGN KEY FK_A75F48959D5230A5');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168B40FDB7B');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses DROP FOREIGN KEY FK_753AD140405F6168');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE materials_in_warehouse');
        $this->addSql('DROP TABLE materials_in_warehouse_ware_houses');
        $this->addSql('DROP TABLE materials_in_warehouse_articles');
        $this->addSql('DROP TABLE units');
        $this->addSql('DROP TABLE ware_houses');
    }
}
