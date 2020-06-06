<?php declare(strict_types=1);

namespace Src\Models\Interfaces;

interface DatabaseInterface
{
    public function openConnection(): void;

    public function closeConnection(): void;

    public function runQuery(string $query): void;

    public function fetchAssocData(): ?array;

    public function fetchArray(): ?array;
}