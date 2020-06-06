<?php declare(strict_types=1);

namespace Src\Services\Interfaces;

interface ProductServiceInterface
{
    public function getIdFromTheBestSellingProductFromList(?array $list): ?int;

    public function getProductById($id);

    public function getProductDetailsToLanguage(array $product): array;

    public function getAllProductsToShowOnHTML(): ?array;
}