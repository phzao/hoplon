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

    public function update(array $product)
    {
        $values = " name_pt=".$this->setField($product["name_pt"]);
        $values .= " name_en=".$this->setField($product["name_en"]);
        $values .= " name_fr=".$this->setField($product["name_fr"]);
        $values .= " name_es=".$this->setField($product["name_es"]);
        $values .= " name_ru=".$this->setField($product["name_ru"]);

        $values .= " price_pt=".$this->setField($product["price_pt"]);
        $values .= " price_en=".$this->setField($product["price_en"]);
        $values .= " price_ru=".$this->setField($product["price_ru"]);
        $values .= " price_fr=".$this->setField($product["price_fr"]);
        $values .= " price_es=".$this->setField($product["price_es"]);

        $values .= " sale_price_pt=".$this->setField($product["sale_price_pt"]);
        $values .= " sale_price_en=".$this->setField($product["sale_price_en"]);
        $values .= " sale_price_fr=".$this->setField($product["sale_price_fr"]);
        $values .= " sale_price_es=".$this->setField($product["sale_price_es"]);
        $values .= " sale_price_ru=".$this->setField($product["sale_price_ru"]);

        $values .= " sale_start=".$this->setField($product["sale_start"]);
        $values .= " sale_end=".$this->setField($product["sale_end"], false);

        $sql = "UPDATE products SET $values WHERE id = ".$product["id"].";";

        return $this->entityManager->runQuery($sql);
    }

    public function save(array $product)
    {
        $values = $this->setField($product["name_pt"]);
        $values .= $this->setField($product["name_en"]);
        $values .= $this->setField($product["name_fr"]);
        $values .= $this->setField($product["name_es"]);
        $values .= $this->setField($product["name_ru"]);

        $values .= $this->setField($product["price_pt"]);
        $values .= $this->setField($product["price_en"]);
        $values .= $this->setField($product["price_fr"]);
        $values .= $this->setField($product["price_es"]);
        $values .= $this->setField($product["price_ru"]);

        $values .= $this->setField($product["sale_price_pt"]);
        $values .= $this->setField($product["sale_price_en"]);
        $values .= $this->setField($product["sale_price_fr"]);
        $values .=$this->setField($product["sale_price_es"]);
        $values .= $this->setField($product["sale_price_ru"]);

        $values .= $this->setField($product["sale_start"]);
        $values .= $this->setField($product["sale_end"], false);

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

        return $this->entityManager->runQuery($sql);
    }

    private function getSelectString()
    {
        $columnsDefault = "id, sale_start, sale_end, ";

        if ($this->language === 'en') {
            return $columnsDefault."name_pt name, price_en price, sale_price_en sale_price";
        } elseif ($this->language === 'fr') {
            return $columnsDefault."name_fr name, price_fr price, sale_price_fr sale_price";
        } elseif ($this->language === 'es') {
            return $columnsDefault."name_es name, price_es price, sale_price_es sale_price";
        } elseif ($this->language === 'ru') {
            return $columnsDefault."name_ru name, price_ru price, sale_price_ru sale_price";
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