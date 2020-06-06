<?php declare(strict_types=1);

namespace Src\Pages;

use Src\Services\Interfaces\HistoryServiceInterface;
use Src\Services\Interfaces\ProductServiceInterface;

class ProductHTML
{
    private $historyService;
    private $productService;

    public function __construct(HistoryServiceInterface $historyService,
                                ProductServiceInterface $productService)
    {
        $this->historyService = $historyService;
        $this->productService = $productService;
    }

    public function header()
    {
        echo "<h2>Produtos</h2>";
    }

    public function showTheBestSellingProduct(): string
    {
        $product = $this->historyService->getTheBestSellingProduct();

        if ($product) {
            $offHtml = "";
            if (!empty($product["off_price"])) {
                $offHtml = '<span class="sale">'.$product["off_price"].' off </span>';
            }

            echo '
            <div style="display: block;position: relative">
                <h3>Produto mais vendido</h3>
                <div class="product_item" style="float: none">
                    <span class="name">'.$product["name"].'</span>
                    <span class="price">'.$product["price"].'</span>
                    '.$offHtml.'
                    <a href="#" onclick="comprar_item(\'buy_item.php?id='.$product["id"].'\', '.$product["price"].')">Buy</a>
                </div>
            </div>
            ';
        }

        return '';
    }

    public function showOneProduct(?array $product): string
    {
        if ($product) {
            $offHtml = "";
            if (!empty($product["off_price"])) {
                $offHtml = '<span class="sale">'.$product["off_price"].' off </span>';
            }

            return '
                <div class="product_item">
                    <div class="product_item" style="float: none">
                        <span class="name">'.$product["name"].'</span>
                        <span class="price">'.$product["price"].'</span>
                        '.$offHtml.'
                        <a href="#" onclick="comprar_item(\'buy_item.php?id='.$product["id"].'\', '.$product["price"].')">Buy</a>
                    </div>
	            </div>
            ';
        }

        return '';
    }

    public function showProducts()
    {
        $productList = $this->productService->getAllProductsToShowOnHTML();

        $listHTML = "0 results";

        if ($productList) {
            $listHTML = "";
            foreach($productList as $item)
            {
                $listHTML.= $this->showOneProduct($item);
            }
        }
        echo '
        <div style="display: block;position: relative">
            <h3>Todos os produtos </h3>
            '.$listHTML.'
            </div>
        </div>
        ';
    }
}