<?php declare(strict_types=1);

namespace Src\Models;

use Src\Models\Interfaces\ProductInterface;
use Src\Traits\FormatNumbers;

class Product implements ProductInterface
{
    use FormatNumbers;

    private $lang;

    private $attributes = [
        ""
    ];

    public function __construct(string $lang)
    {
        $this->lang = $lang;
    }

    public function getProductDetails(array $product): array
    {
        $productData = $product;

        if (!isset($product["price"])) {
            $productData = $this->getProductDataFromLanguage($product);
        }

        $productData["id"] = $product["id"];
        $productSales = $this->getSalesDetails($product);

        $productData = array_merge($productData, $productSales);

        if (!empty($productData['sale_start'])) {
            $productData["off_price"] = $this->getOffPriceFromProduct($productData);
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
        $discount = $product["sale_price"] - $product["sale_price"];
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
        if ($this->lang == 'PT') {
            return [
                "price" => $this->formatCurrencyTwoDecimals((float)$product['price_pt']),
                "sale_price" => $this->formatCurrencyTwoDecimals((float)$product['sale_price_pt']),
                "name" => $product['name_pt']
            ];
        }
        if ($this->lang == 'FR') {
            return [
            "price" => $this->formatCurrencyTwoDecimals((float)$product['price_fr']),
            "sale_price" => $this->formatCurrencyTwoDecimals((float)$product['sale_price_fr']),
            "name" => $product['name_fr']
            ];
        }

        return [
            "price" => $this->formatCurrencyTwoDecimals((float)$product['price_en']),
            "sale_price" => $this->formatCurrencyTwoDecimals((float)$product['sale_price_en']),
            "name" => $product['name_en']
        ];
    }
}