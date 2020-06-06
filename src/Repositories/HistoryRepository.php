<?php declare(strict_types=1);

namespace Src\Repositories;

use Src\Models\Interfaces\DatabaseInterface;
use Src\Repositories\Interfaces\HistoryRepositoryInterface;

class HistoryRepository extends BaseRepository implements HistoryRepositoryInterface
{
    public function __construct(DatabaseInterface $database)
    {
        $this->entityManager = $database;
    }

    public function getTopSellingProducts(): ?array
    {
        $sql = "select product_id, count(id) vezes from history where language = '$this->language' group by product_id";

        $this->entityManager->runQuery($sql);

        return $this->entityManager->fetchArray();
    }
}