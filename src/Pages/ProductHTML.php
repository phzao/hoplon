<?php declare(strict_types=1);

namespace Src\Pages;

use Src\Services\Interfaces\HistoryServiceInterface;
use Src\Services\Interfaces\ProductServiceInterface;

class ProductHTML
{
    private $historyService;
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function setHistoryService(HistoryServiceInterface $historyService)
    {
        $this->historyService = $historyService;
    }

    public function showRegisterSaleStatus($product_id)
    {
        if(!$this->productService->makeASale($_GET["id"])) {
            echo "";
        }

        $saleDetails = $this->productService->getSaleDetails();
        $this->historyService->registerSale($saleDetails);

        echo "<h2>Item comprado com sucesso!</h2>";
    }

    public function header()
    {
        echo "<h2>Produtos</h2>";
    }

    public function showAddProductButton()
    {
        echo '<button class="incluir_button" style="margin: 10px;" onclick="window.location.href=\'add_products.php\'">Cadastrar</button>';
    }

    public function initTableToShowProductList()
    {
        echo '<table class="table-list" border="0" cellspacing="0" cellpadding="0">
         <tr>
			<th>Id</th>
			<th>Name PT</th>
			<th>Name EN</th>
			<th>Name FR</th>
			<th>Price PT</th>
			<th>Price EN</th>
			<th>Price FR</th>
			<th>Action</th>
		</tr>';
    }

    public function endTable()
    {
        echo '	</table>
	          </div>';
    }

    public function showTheBestSellingProduct(): string
    {
        $product = $this->historyService->getTheBestSellingProduct();

        if ($product)
        {
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

    public function getOneProductToList(array $product): string
    {
        if ($product)
        {
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

    private function getProductRowToTable(array $product): string
    {
        return '
        <tr>
            <td style="text-align: center">'.$product["id"].'</td>
            <td>'.$product["name_pt"].'</td>
            <td>'.$product["name_en"].'</td>
            <td>'.$product["name_fr"].'</td>
            <td style="text-align: center">'.$product["price_pt"].'</td>
            <td style="text-align: center">'.$product["price_en"].'</td>
            <td style="text-align: center">'.$product["price_fr"].'</td>
            <td style="text-align: center"><a href="edit_products.php">editar</a></td>
        </tr>';
    }

    public function showItemTableAdmin()
    {
        $productList = $this->productService->getAllProducts();

        $listHTML = "0 results";

        if ($productList)
        {
            $listHTML = "";
            foreach($productList as $item)
            {
                $listHTML.= $this->getProductRowToTable($item);
            }
        }

        echo $listHTML;
    }

    public function showProducts()
    {
        $productList = $this->productService->getAllProductsToShowOnHTML();

        $listHTML = "0 results";

        if ($productList)
        {
            $listHTML = "";
            foreach($productList as $item)
            {
                $listHTML.= $this->getOneProductToList($item);
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