<?php declare(strict_types=1);

namespace Src\Models;

use Src\Models\Interfaces\LanguageSettingInterface;

class LanguageSetting implements LanguageSettingInterface
{
    // Languages we support
    private $available_languages;

    private $default_language; // a default language to fall back to in case there's no match

    public function __construct($default_language = "pt",
                                $available_languages = ["pt", "fr", "en"])
    {
        $this->available_languages = $available_languages;
        $this->default_language = $default_language;
    }

    public function getPreferredLanguage($http_accept_language): string
    {
        global $default_language;

        $available_languages = array_flip($this->available_languages);

        $languages = [];

        preg_match_all('~([\w-]+)(?:[^,\d]+([\d.]+))?~',
                       strtolower($http_accept_language),
                       $matches,
                       PREG_SET_ORDER);

        foreach($matches as $match)
        {
            list($a, $b) = explode('-', $match[1]) + array('', '');
            $value = isset($match[2]) ? (float) $match[2] : 1.0;

            if(isset($available_languages[$match[1]])) {
                $languages[$match[1]] = $value;
                continue;
            }
            if(isset($available_languages[$a])) {
                $languages[$a] = $value - 0.1;
            }
        }

        $language_set = $default_language;

        if($languages) {
            arsort($languages);
            $language_set = key($languages); // We don't need the whole array of choices since we have a match
        }

        return strtoupper($language_set);
    }
}