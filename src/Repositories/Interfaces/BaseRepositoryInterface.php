<?php

namespace Src\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function setField($value, $addComma = true): string;

    public function save(array $product);

    public function update(array $product);
}