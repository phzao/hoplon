<?php declare(strict_types=1);

namespace Src\Models;

use Src\Models\Interfaces\ProductInterface;
use Src\Traits\FormatDate;
use Src\Traits\FormatNumbers;

class Product implements ProductInterface
{
    use FormatNumbers, FormatDate;

    private $lang;

    private $attributes = [
        "id",
        "name_pt",
        "name_es",
        "name_en",
        "name_fr",
        "name_ru",
        "price_pt",
        "price_es",
        "price_en",
        "price_fr",
        "price_ru",
        "sale_price_pt",
        "sale_price_en",
        "sale_price_es",
        "sale_price_ru",
        "sale_price_fr",
        "sale_end",
        "sale_start"
    ];

    public function __construct(string $lang = "en")
    {
        $this->lang = $lang;
    }

    public function getProductDetails(array $product): array
    {
        $productData = $product;

        if (empty($product)) {
            return $productData;
        }

        if (!isset($product["price"])) {
            $productData = $this->getProductDataFromLanguage($product);
        }

        if (isset($product["id"])) {
            $productData["id"] = $product["id"];
        }
        $productSales = $this->getSalesDetails($product);

        if (!empty($productSales)) {
            $productData = array_merge($productData, $productSales);
        }

        if (!empty($productData['sale_start'])) {

            $off_price = $this->getOffPriceFromProduct($productData);
            if (!empty($off_price)) {
                $productData = array_merge($productData, $off_price);
            }
        }

        return $productData;
    }

    private function getSalesDetails(array $product): array
    {
        $salesDetail = [];

        if (empty($product["sale_start"])) {
            return $salesDetail;
        }

        return [
            "sale_start" => $product['sale_start'],
            "sale_end" => $product['sale_end']
        ];
    }

    public function isOpenToSelling(array $product): bool
    {
        if (empty($product["sale_start"]) || empty($product["sale_end"])) {
            return false;
        }

        $DateStart = strtotime($product['sale_start']);
        $DateEnd = strtotime($product['sale_end']);
        $now = time();

        if ($DateStart <= $now && $now <= $DateEnd) {
            return true;
        }

        return false;
    }

    private function getOffPriceFromProduct(array $product): ?array
    {
        $price = $this->formatCurrencyTwoDecimals((float)$product["sale_price"]);
        $discount = 0;
        if (is_float($product["price"]) && is_float($product["sale_price"])) {
            $discount = $product["price"] - $product["sale_price"];
        }

        $off_price = $this->formatCurrencyTwoDecimals((float)$discount);

        if ($this->isOpenToSelling($product)) {
            return [
                "price" => $price,
                "off_price" => $off_price
            ];
        }

        return null;
    }

    private function getProductDataFromLanguage(array $product): array
    {
        if ($this->lang === 'PT') {
            $pt["price"] = !empty($product['price_pt'])?$this->formatCurrencyTwoDecimals((float)$product['price_pt']): "";
            $pt["sale_price"] = !empty($product['sale_price_pt'])?$this->formatCurrencyTwoDecimals((float)$product['sale_price_pt']): "";
            $pt["name"] = !empty($product['name_pt'])?$product['name_pt']: "";

            return $pt;
        }

        if ($this->lang === 'FR') {
            $fr["price"] = !empty($product['price_fr'])?$this->formatCurrencyTwoDecimals((float)$product['price_fr']): "";
            $fr["sale_price"] = !empty($product['sale_price_fr'])?$this->formatCurrencyTwoDecimals((float)$product['sale_price_fr']): "";
            $fr["name"] = !empty($product['name_fr'])?$product['name_fr']: "";

            return $fr;
        }

        if ($this->lang === 'RU') {
            $ru["price"] = !empty($product['price_ru'])?$this->formatCurrencyTwoDecimals((float)$product['price_ru']): "";
            $ru["sale_price"] = !empty($product['sale_price_ru'])?$this->formatCurrencyTwoDecimals((float)$product['sale_price_ru']): "";
            $ru["name"] = !empty($product['name_ru'])?$product['name_ru']: "";

            return $ru;
        }

        if ($this->lang === 'ES') {
            $es["price"] = !empty($product['price_es'])?$this->formatCurrencyTwoDecimals((float)$product['price_es']): "";
            $es["sale_price"] = !empty($product['sale_price_es'])?$this->formatCurrencyTwoDecimals((float)$product['sale_price_es']): "";
            $es["name"] = !empty($product['name_es'])?$product['name_es']: "";

            return $es;
        }

        $en["price"] = !empty($product['price_en'])?$this->formatCurrencyTwoDecimals((float)$product['price_en']): "";
        $en["sale_price"] = !empty($product['sale_price_en'])?$this->formatCurrencyTwoDecimals((float)$product['sale_price_en']): "";
        $en["name"] = !empty($product['name_en'])?$product['name_en']: "";

        return $en;
    }

    public function getProductFilled(array $request): array
    {
        $product = [];

        if (empty($request)) {
            return $product;
        }

        foreach($this->attributes as $field)
        {
            $product[$field] = "null";

            if (($field === "sale_start" || $field === "sale_end") && isset($request[$field])) {
                $product[$field] = $this->fixInputDatetimeToDatabaseDatetime($request[$field]);
                continue;
            }

            if (isset($request[$field]) && !empty($request[$field])) {
                $product[$field] = $request[$field];
            }
        }

        return $product;
    }
}