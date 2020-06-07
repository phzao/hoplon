<?php declare(strict_types=1);

namespace Src\Migrations;

use Src\Models\Interfaces\DatabaseInterface;

class MigrationTestDB
{
    protected $entityManager;

    public function __construct(DatabaseInterface $database)
    {
        $this->entityManager = $database;
    }

    public function clearDB(): void
    {
        $sql = "DROP TABLE products, history;";

        $this->entityManager->runQuery($sql);
    }

    public function migration20200001(): void
    {
        $sql = "
                CREATE TABLE `products` (
                    `id` INT(10) NOT NULL AUTO_INCREMENT,
                    `name_pt` VARCHAR(200) NULL DEFAULT NULL,
                    `name_en` VARCHAR(200) NULL DEFAULT NULL,
                    `name_fr` VARCHAR(200) NULL DEFAULT NULL,
                    `price_pt` FLOAT NULL DEFAULT NULL,
                    `price_en` FLOAT NULL DEFAULT NULL,
                    `price_fr` FLOAT NULL DEFAULT NULL,
                    `sale_start` DATETIME NULL DEFAULT NULL,
                    `sale_end` DATETIME NULL DEFAULT NULL,
                    `sale_price_pt` FLOAT NULL DEFAULT NULL,
                    `sale_price_en` FLOAT NULL DEFAULT NULL,
                    `sale_price_fr` FLOAT NULL DEFAULT NULL,
                
                    PRIMARY KEY (`id`)
                )
                COLLATE='utf8_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;";

        $this->entityManager->runQuery($sql);
    }

    public function migration20200002(): void
    {
        $sql = "
                CREATE TABLE `history` (
                    `id` INT(10) NOT NULL AUTO_INCREMENT,
                    `product_id` INT(10) NOT NULL,
                    `language` VARCHAR(2) NOT NULL,
                    `price` FLOAT(2) NOT NULL,
                    `sale`  INT(1) NOT NULL,
                    `date` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`id`)
                )
                COLLATE='utf8_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=1
                ;";

        $this->entityManager->runQuery($sql);
    }

    public function migration20200003(): void
    {
        $sql = "
        ALTER TABLE products
            ADD COLUMN `name_es` VARCHAR(200) NULL DEFAULT NULL,
            ADD COLUMN `price_es` FLOAT NULL DEFAULT NULL,
            ADD COLUMN `sale_price_es` FLOAT NULL DEFAULT NULL,
            ADD COLUMN `name_ru` VARCHAR(200) NULL DEFAULT NULL,
            ADD COLUMN `price_ru` FLOAT NULL DEFAULT NULL,
            ADD COLUMN `sale_price_ru` FLOAT NULL DEFAULT NULL
        ";

        $this->entityManager->runQuery($sql);
    }
}