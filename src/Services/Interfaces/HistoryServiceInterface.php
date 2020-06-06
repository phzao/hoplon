<?php declare(strict_types=1);

namespace Src\Services\Interfaces;

interface HistoryServiceInterface
{
    public function getTheBestSellingProduct(): ?array;

    public function registerSale(array $saleDetail);
}