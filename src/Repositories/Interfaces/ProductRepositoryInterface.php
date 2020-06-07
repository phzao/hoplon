<?php declare(strict_types=1);

namespace Src\Repositories\Interfaces;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getProductById($id): ?array;

    public function getAllProductsByLanguage(): ?array;

    public function getAllProducts(): ?array;

    public function getProductByIdToBuy($id): ?array;
}