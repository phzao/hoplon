<?php declare(strict_types=1);

namespace Src\Repositories\Interfaces;

interface HistoryRepositoryInterface
{
    public function setLanguage(string $lang): void;

    public function getTopSellingProducts(): ?array;
}