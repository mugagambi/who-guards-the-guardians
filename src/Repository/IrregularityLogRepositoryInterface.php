<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\IrregularityLog;

interface IrregularityLogRepositoryInterface
{
    /**
     * @return IrregularityLog[]
     */
    public function findBy(array $criteria): array;
}
