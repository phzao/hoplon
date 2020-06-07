<?php declare(strict_types=1);

namespace Src\Models\Interfaces;

interface LanguageSettingInterface
{
    public function getPreferredLanguage($http_accept_language): string;

    public function getLanguageDefault(): string;
}