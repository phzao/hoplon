<?php declare(strict_types=1);

namespace Src\Pages\Interfaces;

interface LayoutInterface
{
    public function showHeaderHtml(): void;

    public function showFooterHTML(): void;
}