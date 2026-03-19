<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\IrregularityLog;
use App\Repository\IrregularityLogRepositoryInterface;
use App\Service\Flawed\AuditorExport;
use PHPUnit\Framework\TestCase;

class AuditorExportTest extends TestCase
{
    public function testGenerateCsv_FLAWED(): void
    {
        $repository = $this->createMock(IrregularityLogRepositoryInterface::class);
        $logs = [
            new IrregularityLog('log-1', 2024, 'Desc 1'),
            new IrregularityLog('log-2', 2024, 'Desc 2'),
        ];
        $repository->method('findBy')->willReturn($logs);

        $export = new AuditorExport($repository);
        $csv = $export->generateCsv(2024);

        $this->assertStringContainsString('log-1,2024,"Desc 1"', $csv);
        $this->assertStringContainsString('log-2,2024,"Desc 2"', $csv);
    }
}
