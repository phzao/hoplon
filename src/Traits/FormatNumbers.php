<?php declare(strict_types=1);

namespace Src\Traits;

trait FormatNumbers
{
    public function formatCurrencyTwoDecimals(float $value): string
    {
        return number_format($value, 2);
    }
}