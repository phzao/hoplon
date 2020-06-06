<?php declare(strict_types=1);

namespace Src\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductById($id): ?array;

    public function getAllProductsByLanguage(): ?array;
}