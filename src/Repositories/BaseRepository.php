<?php declare(strict_types=1);

namespace Src\Repositories;

class BaseRepository
{
    protected $entityManager;

    protected $language;

    public function setLanguage(string $lang): void
    {
        $this->language = $lang;
    }
}