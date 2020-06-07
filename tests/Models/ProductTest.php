<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\Models\Product;
use Src\Models\Interfaces\ProductInterface;

class ProductTest extends TestCase
{
    public function testObjectAndInterfaceShouldExist()
    {
        $product = new Product();
        $this->assertInstanceOf(ProductInterface::class, $product);
    }

    public function testGetProductDetailsPassAnEmptyArrayShouldReturnAnEmptyArray()
    {
        $product = new Product();
        $this->assertIsArray($product->getProductDetails([]));
        $this->assertEmpty($product->getProductDetails([]));
    }

    public function testGetProductDetailsWithDefaultLanguageEnShouldReturnFormattedDataToEN()
    {
        $product = new Product();
        $data = [
            "name_pt" => "TV_pt",
            "name_en" => "TV_en",
            "price_pt" => 200.50,
            "price_en" => 100.50,
            "sale_price_pt" => 500.20,
            "sale_price_en" => 200.30,
        ];

        $productFormatted = $product->getProductDetails($data);

        $this->assertIsArray($productFormatted);
        $this->assertEquals([100.50, 200.30, "TV_en"], array_values($productFormatted));
        $this->assertCount(3, $productFormatted);
    }

    public function testGetProductDetailsWithPTLanguageEnShouldReturnFormattedDataToPT()
    {
        $product = new Product("PT");
        $data = [
            "name_pt" => "TV_pt",
            "name_en" => "TV_en",
            "price_pt" => 200.50,
            "price_en" => 100.50,
            "sale_price_pt" => 500.20,
            "sale_price_en" => 200.30,
        ];

        $productFormatted = $product->getProductDetails($data);

        $this->assertIsArray($productFormatted);
        $this->assertEquals([200.50, 500.20, "TV_pt"], array_values($productFormatted));
    }

    public function testIsOpenToSellingShouldReturnFalseArrayWhenPassedAnEmptyArray()
    {
        $product = new Product();

        $this->assertIsBool($product->isOpenToSelling([]));
        $this->assertFalse($product->isOpenToSelling([]));
    }

    public function testIsOpenToSellingShouldReturnFalseWhenStartAndEndIsOlderThanToday()
    {
        $product = new Product();
        $data = [
            "sale_start" => "2001-01-01 10:00:00",
            "sale_end" => "2002-01-01 10:00:00"
        ];

        $this->assertFalse($product->isOpenToSelling($data));
    }

    public function testIsOpenToSellingShouldReturnFalseWhenStartAndEndIsGreaterThanToday()
    {
        $product = new Product();
        $data = [
            "sale_start" => "2001-01-01 10:00:00",
            "sale_end" => "2002-01-01 10:00:00"
        ];

        $this->assertFalse($product->isOpenToSelling($data));
    }

    public function testIsOpenToSellingShouldReturnFalseWhenNowIsOnAStartEndRange()
    {
        $product = new Product();
        $data = [
            "sale_start" => "2019-01-01 10:00:00",
            "sale_end" => "2022-01-01 10:00:00"
        ];

        $this->assertTrue($product->isOpenToSelling($data));
    }

    public function testGetProductFilledShouldReturnEmptyWhenPassedEmpty()
    {
        $product = new Product();

        $this->assertIsArray($product->getProductFilled([]));
        $this->assertEmpty($product->getProductFilled([]));
    }

    public function testGetProductFilledPassingAttributesUnknownWillBeIgnoredAndOnlySetProductAttributesFromClass()
    {
        $product = new Product();
        $data = [
            "feijao" => "123",
            "arroz" => "123",
            "name_pt" => "TV_pt",
            "name_en" => "TV_en",
            "price_pt" => 200.50,
            "price_en" => 100.50,
            "sale_price_pt" => 500.20,
            "sale_price_en" => 200.30,
        ];

        $productSet = $product->getProductFilled($data);

        $this->assertIsArray($productSet);
        $this->assertCount(18, $productSet);
        $this->assertNotContains(["feijao", "arroz"], array_keys($productSet));
    }
}