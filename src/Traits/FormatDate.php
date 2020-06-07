<?php declare(strict_types=1);

namespace Src\Traits;

trait FormatDate
{
    public function fixInputDatetimeToDatabaseDatetime(string $datetime): string
    {
        $datetime = new \DateTime($datetime);

        return $datetime->format("Y-m-d H:i:s");
    }

    public function getISOStringDatetime(string $datetime)
    {
        $datetime = new \DateTime($datetime);

        return $datetime->format("Y-m-d\TH:i:s");
    }
}