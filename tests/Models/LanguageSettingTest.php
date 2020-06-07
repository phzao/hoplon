<?php declare(strict_types=1);

namespace App\Tests\Models;

use PHPUnit\Framework\TestCase;
use Src\Models\LanguageSetting;
use Src\Models\Interfaces\LanguageSettingInterface;

class LanguageSettingTest extends TestCase
{
    public function testObjectAndInterfaceShouldExist()
    {
        $language = new LanguageSetting();
        $this->assertInstanceOf(LanguageSettingInterface::class, $language);
    }

    public function testLanguageSettingToFRShouldReturnFR()
    {
        $language = new LanguageSetting('fr');

        $this->assertEquals("FR", $language->getLanguageDefault());
    }
}