<?php declare(strict_types=1);

namespace Src\Services\Interfaces;

interface ProductServiceInterface
{
    public function getIdFromTheBestSellingProductFromList(?array $list): ?int;

    public function getProductById($id): ?array;

    public function getProductDetailsToLanguage(array $product): array;

    public function getAllProductsToShowOnHTML(): ?array;

    public function getAllProducts(): ?array;

    public function getProductByIdToBuy($id): ?array;

    public function makeASale($product_id): bool;

    public function getSaleDetails(): array;

    public function registeringProduct(array $request);

    public function changingProduct(array $request);
}