<?php declare(strict_types=1);

namespace Src\Pages;

use Src\Services\Interfaces\HistoryServiceInterface;

class HistoryHTML
{
    private $historyService;

    public function __construct(HistoryServiceInterface $historyService)
    {
        $this->historyService = $historyService;
    }

    public function showTopSelling()
    {
        $product = $this->historyService->getTheBestSellingProduct();

        if ($product) {

            $offHtml = "";
            if (!empty($product["off_price"])) {
                $offHtml ='<span class="sale">'.$product["off_price"].' off </span>';
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
    }
}