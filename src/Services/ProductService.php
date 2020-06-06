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

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function getProductDetailsToLanguage(array $product): array
    {
        return $this->product->getProductDetails($product);
    }

    public function getAllProductsToShowOnHTML(): ?array
    {
        return $this->productRepository->getAllProductsByLanguage();
    }
}