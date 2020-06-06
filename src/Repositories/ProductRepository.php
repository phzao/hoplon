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

    public function getAllProductsByLanguage(): ?array
    {
        $sql = "SELECT id, name_en name, price_en price, sale_start, sale_end, sale_price_en sale_price FROM products";

        if ($this->language == 'pt') {
            $sql = "SELECT id, name_pt name, price_pt price, sale_start, sale_end, sale_price_pt sale_price FROM products";
        } elseif ($this->language == 'fr') {
            $sql = "SELECT id, name_fr name, price_fr price, sale_start, sale_end, sale_price_fr sale_price FROM products";
        }

        $this->entityManager->runQuery($sql);

        return $this->entityManager->fetchArray();
    }
}