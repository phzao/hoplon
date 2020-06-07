<?php declare(strict_types=1);

namespace Src\Models\Interfaces;

interface ProductInterface
{
    public function getProductDetails(array $product): array;

    public function isOpenToSelling(array $product): bool;

    public function getProductFilled(array $request): array;
}