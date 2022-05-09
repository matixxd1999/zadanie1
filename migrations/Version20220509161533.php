<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509161533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin_warehouses');
        $this->addSql('DROP TABLE materials_in_warehouse_articles');
        $this->addSql('DROP TABLE materials_in_warehouse_ware_houses');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE materials_in_warehouse ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materials_in_warehouse ADD CONSTRAINT FK_33ED9C977294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_33ED9C977294869C ON materials_in_warehouse (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_warehouses (admin_id INT NOT NULL, warehouses_id INT NOT NULL, INDEX IDX_67D76432642B8210 (admin_id), INDEX IDX_67D76432864AC21A (warehouses_id), PRIMARY KEY(admin_id, warehouses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materials_in_warehouse_articles (materials_in_warehouse_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_A75F48951EBAF6CC (articles_id), INDEX IDX_A75F48959D5230A5 (materials_in_warehouse_id), PRIMARY KEY(materials_in_warehouse_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materials_in_warehouse_ware_houses (materials_in_warehouse_id INT NOT NULL, ware_houses_id INT NOT NULL, INDEX IDX_753AD140405F6168 (ware_houses_id), INDEX IDX_753AD1409D5230A5 (materials_in_warehouse_id), PRIMARY KEY(materials_in_warehouse_id, ware_houses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE admin_warehouses ADD CONSTRAINT FK_67D76432642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_warehouses ADD CONSTRAINT FK_67D76432864AC21A FOREIGN KEY (warehouses_id) REFERENCES ware_houses (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles ADD CONSTRAINT FK_A75F48951EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_articles ADD CONSTRAINT FK_A75F48959D5230A5 FOREIGN KEY (materials_in_warehouse_id) REFERENCES materials_in_warehouse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses ADD CONSTRAINT FK_753AD140405F6168 FOREIGN KEY (ware_houses_id) REFERENCES ware_houses (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse_ware_houses ADD CONSTRAINT FK_753AD1409D5230A5 FOREIGN KEY (materials_in_warehouse_id) REFERENCES materials_in_warehouse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materials_in_warehouse DROP FOREIGN KEY FK_33ED9C977294869C');
        $this->addSql('DROP INDEX IDX_33ED9C977294869C ON materials_in_warehouse');
        $this->addSql('ALTER TABLE materials_in_warehouse DROP article_id');
    }
}
