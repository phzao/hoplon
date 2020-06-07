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

    public function save(array $product)
    {
        $values = $product["name_pt"] === 'null' ? $product["name_pt"].',': '\''.$product["name_pt"].'\',';
        $values .= $product["name_en"] === 'null' ? $product["name_en"].',': '\''.$product["name_en"].'\',';
        $values .= $product["name_fr"] === 'null' ? $product["name_fr"].',': '\''.$product["name_fr"].'\',';
        $values .= $product["name_es"] === 'null' ? $product["name_es"].',': '\''.$product["name_es"].'\',';
        $values .= $product["name_ru"] === 'null' ? $product["name_ru"].',': '\''.$product["name_ru"].'\',';
        $values .= $product["price_pt"] === 'null' ? $product["price_pt"].',': '\''.$product["price_pt"].'\',';
        $values .= $product["price_en"] === 'null' ? $product["price_en"].',': '\''.$product["price_en"].'\',';
        $values .= $product["price_fr"] === 'null' ? $product["price_fr"].',': '\''.$product["price_fr"].'\',';
        $values .= $product["price_es"] === 'null' ? $product["price_es"].',': '\''.$product["price_es"].'\',';
        $values .= $product["price_ru"] === 'null' ? $product["price_ru"].',': '\''.$product["price_ru"].'\',';
        $values .= $product["sale_price_pt"] === 'null' ? $product["sale_price_pt"].',': '\''.$product["sale_price_pt"].'\',';
        $values .= $product["sale_price_en"] === 'null' ? $product["sale_price_en"].',': '\''.$product["sale_price_en"].'\',';
        $values .= $product["sale_price_fr"] === 'null' ? $product["sale_price_fr"].',': '\''.$product["sale_price_fr"].'\',';
        $values .= $product["sale_price_es"] === 'null' ? $product["sale_price_es"].',': '\''.$product["sale_price_es"].'\',';
        $values .= $product["sale_price_ru"] === 'null' ? $product["sale_price_ru"].',': '\''.$product["sale_price_ru"].'\',';
        $values .= $product["sale_start"] === 'null' ? $product["sale_start"].',': '\''.$product["sale_start"].'\',';
        $values .= $product["sale_end"] === 'null' ? $product["sale_end"]: '\''.$product["sale_end"].'\'';

        $sql = "
        insert into products (name_pt, 
                              name_en, 
                              name_fr, 
                              name_es, 
                              name_ru, 
                              price_pt, 
                              price_en, 
                              price_fr,
                              price_es,
                              price_ru,
                              sale_price_pt, 
                              sale_price_en, 
                              sale_price_fr,
                              sale_price_es,
                              sale_price_ru,
                              sale_start, 
                              sale_end) 
          values($values);
        ";
        $this->entityManager->runQuery($sql);
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