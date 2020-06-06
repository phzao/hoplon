<?php declare(strict_types=1);

namespace Src\Pages\Interfaces;

interface LayoutInterface
{
    public function showHeaderHtml(string $breadcrumbs): void;

    public function showFooterHTML(): void;

    public function startContent(): void;

    public function endContent(): void;
}