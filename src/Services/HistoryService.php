<?php declare(strict_types=1);

namespace Src\Services;

use Src\Models\Interfaces\DatabaseInterface;
use Src\Repositories\HistoryRepository;
use Src\Services\Interfaces\HistoryServiceInterface;
use Src\Services\Interfaces\ProductServiceInterface;

class HistoryService implements HistoryServiceInterface
{
    private $historyRepository;
    private $productService;

    public function __construct(string $language,
                                DatabaseInterface $db,
                                ProductServiceInterface $productService)
    {
        $this->historyRepository = new HistoryRepository($db);
        $this->historyRepository->setLanguage($language);
        $this->productService = $productService;
    }

    public function getTheBestSellingProduct(): ?array
    {
        $topSellingList = $this->historyRepository->getTopSellingProducts();
        $productId = $this->productService->getIdFromTheBestSellingProductFromList($topSellingList);

        if (!$productId) {
            return null;
        }

        $product = $this->productService->getProductById($productId);
        return $this->productService->getProductDetailsToLanguage($product);
    }
}