<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221203125321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_user DROP FOREIGN KEY FK_C062EC5EA76ED395');
        $this->addSql('ALTER TABLE order_user DROP FOREIGN KEY FK_C062EC5ECFFE9AD6');
        $this->addSql('DROP TABLE order_user');
        $this->addSql('ALTER TABLE `order` CHANGE name_product name_product VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, orders_id INT NOT NULL, UNIQUE INDEX UNIQ_C062EC5EA76ED395 (user_id), UNIQUE INDEX UNIQ_C062EC5ECFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE order_user ADD CONSTRAINT FK_C062EC5EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_user ADD CONSTRAINT FK_C062EC5ECFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `order` CHANGE name_product name_product VARCHAR(255) DEFAULT NULL');
    }
}
