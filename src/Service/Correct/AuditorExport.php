<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Repository\IrregularityLogRepositoryInterface;

class AuditorExport
{
    public function __construct(
        private readonly IrregularityLogRepositoryInterface $repository,
    ) {}

    public function generateCsv(int $year): string
    {
        // The Fix: Simulate retrieving all records safely, e.g., iterating or handling a paginator.
        // For the sake of this mock demo, we'll pretend the interface allows fetching everything explicitly
        // (Even in reality we'd use Doctrine batching/pagination, but functionally we must fetch all).
        
        $logs = $this->repository->findBy(['year' => $year]);
        
        $csv = "id,year,description\n";
        foreach ($logs as $log) {
            $csv .= sprintf("%s,%d,\"%s\"\n", $log->getId(), $log->getYear(), $log->getDescription());
        }

        return $csv;
    }
}
