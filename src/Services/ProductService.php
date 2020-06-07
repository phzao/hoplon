<?php

namespace Src\Services;

use Src\Models\Interfaces\DatabaseInterface;
use Src\Models\Product;
use Src\Repositories\ProductRepository;
use Src\Services\Interfaces\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    private $product;
    private $productRepository;
    private $saleData;

    public function __construct(string $language, DatabaseInterface $db)
    {
        $this->product = new Product($language);
        $this->productRepository = new ProductRepository($db);
        $this->productRepository->setLanguage($language);
    }

    public function getIdFromTheBestSellingProductFromList(?array $list): ?int
    {
        $produto_id = null;

        if (!$list) {
            return $produto_id;
        }

        $vezes = 0;

        foreach($list as $product)
        {
            $qtd = $product['vezes'];
            $productId = $product['product_id'];

            if ($qtd > $vezes) {
                $vezes = $qtd;
                $produto_id = $productId;
            }
        }

        return $produto_id;
    }

    public function makeASale($product_id): bool
    {
        if (empty($product_id)) {
            return false;
        }

        $product = $this->getProductByIdToBuy($product_id);

        if (!$product) {
            return false;
        }

        $this->saleData = $this->product->getProductDetails($product);

        $this->saleData["price"] = $product["price"];
        $this->saleData["sale"] = '0';

        if(!$this->product->isOpenToSelling($product)) {
            $this->saleData["sale"] = '1';
        }

        return true;
    }

    public function registeringProduct(array $request)
    {
        $product = $this->product->getProductFilled($request);

        //...TODO Validate
        try {

            return $this->productRepository->save($product);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function changingProduct(array $request)
    {
        $product = $this->product->getProductFilled($request);
        //...TODO Validate
        return $this->productRepository->update($product);
    }

    public function getSaleDetails(): array
    {
        return $this->saleData;
    }

    public function getProductById($id): ?array
    {
        return $this->productRepository->getProductById($id);
    }

    public function getProductByIdToBuy($id): ?array
    {
        return $this->productRepository->getProductByIdToBuy($id);
    }

    public function getProductDetailsToLanguage(array $product): array
    {
        return $this->product->getProductDetails($product);
    }

    public function getAllProductsToShowOnHTML(): ?array
    {
        $list = $this->productRepository->getAllProductsByLanguage();
        $products = [];

        foreach($list as $item)
        {
            $products[] = $this->product->getProductDetails($item);
        }

        return $products;
    }

    public function getAllProducts(): ?array
    {
        return $this->productRepository->getAllProducts();
    }
}