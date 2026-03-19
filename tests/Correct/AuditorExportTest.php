<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\IrregularityLog;
use App\Repository\IrregularityLogRepositoryInterface;
use App\Service\Correct\AuditorExport;
use PHPUnit\Framework\TestCase;

class AuditorExportTest extends TestCase
{
    public function testGenerateCsv_CORRECT(): void
    {
        $repository = $this->createMock(IrregularityLogRepositoryInterface::class);
        
        $logs = [];
        for ($i = 1; $i <= 150; $i++) {
            $logs[] = new IrregularityLog('log-' . $i, 2024, 'Record');
        }

        // We return exactly 150 items. The correct service handles it properly.
        $repository->method('findBy')->willReturn($logs);

        $export = new AuditorExport($repository);
        $csv = $export->generateCsv(2024);

        $lines = explode("\n", $csv);
        $rowCount = count(array_filter($lines)) - 1; 

        // Assert all 150 items are exported.
        $this->assertEquals(150, $rowCount);
    }
}
