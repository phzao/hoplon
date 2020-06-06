<?php declare(strict_types=1);

namespace Src\Models\Interfaces;

interface ProductInterface
{
    public function getProductDetails(array $product): array;
}