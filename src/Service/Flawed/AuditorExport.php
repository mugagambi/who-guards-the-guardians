<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Repository\IrregularityLogRepositoryInterface;

class AuditorExport
{
    public function __construct(
        private readonly IrregularityLogRepositoryInterface $repository,
    ) {}

    public function generateCsv(int $year): string
    {
        // The bug: Relies purely on repository ->findBy returning all results regardless of volume
        $logs = $this->repository->findBy(['year' => $year]);
        
        $csv = "id,year,description\n";
        foreach ($logs as $log) {
            $csv .= sprintf("%s,%d,\"%s\"\n", $log->getId(), $log->getYear(), $log->getDescription());
        }

        return $csv;
    }
}
