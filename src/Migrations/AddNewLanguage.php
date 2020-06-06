<?php declare(strict_types=1);

namespace Src\Migrations;

use Src\Models\Interfaces\DatabaseInterface;
use Src\Repositories\BaseRepository;

class AddNewLanguage extends BaseRepository
{
    public function __construct(DatabaseInterface $database)
    {
        $this->entityManager = $database;
    }

    //`name_en` VARCHAR(200) NULL DEFAULT NULL,
    public function runMigration(): void
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