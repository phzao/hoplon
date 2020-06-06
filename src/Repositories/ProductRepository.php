<?php declare(strict_types=1);

namespace Src\Repositories;

use Src\Models\Interfaces\DatabaseInterface;
use Src\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(DatabaseInterface $database)
    {
        $this->entityManager = $database;
    }

    public function getProductById($id): ?array
    {
        $sql = "select * from products where id = " . $id;

        $this->entityManager->runQuery($sql);

        return $this->entityManager->fetchAssocData();
    }

    private function getSelectString()
    {
        $columnsDefault = "id, sale_start, sale_end, ";

        if ($this->language == 'en') {
            return $columnsDefault."name_pt name, price_en price, sale_price_en sale_price";
        } elseif ($this->language == 'fr') {
            return $columnsDefault."name_fr name, price_fr price, sale_price_fr sale_price";
        } elseif ($this->language == 'es') {
            return $columnsDefault."name_es name, price_es price, sale_price_es sale_price";
        } elseif ($this->language == 'ru') {
            return $columnsDefault."name_ru name, price_ru price, sale_price_ur sale_price";
        }

        return $columnsDefault."name_pt name, price_pt price, sale_price_pt sale_price";

    }

    public function getProductByIdToBuy($id): ?array
    {
        $sql = "SELECT ".$this->getSelectString()." FROM products WHERE id = $id";

        $this->entityManager->runQuery($sql);

        return $this->entityManager->fetchAssocData();
    }

    public function getAllProductsByLanguage(): ?array
    {
        $sql = "SELECT ".$this->getSelectString()." FROM products";

        $this->entityManager->runQuery($sql);

        return $this->entityManager->fetchArray();
    }

    public function getAllProducts(): ?array
    {
        $sql = "SELECT * FROM products";

        $this->entityManager->runQuery($sql);

        return $this->entityManager->fetchArray();
    }
}