<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Manifest;
use App\Service\EpaReporterInterface;
use App\Service\Flawed\SpillDetector;
use PHPUnit\Framework\TestCase;

class SpillDetectorTest extends TestCase
{
    public function testDetectSpill_FLAWED(): void
    {
        $reporter = $this->createMock(EpaReporterInterface::class);
        
        // 10L difference > 0.5L limit
        $reporter->expects($this->once())->method('reportSpill')->with(10.0);

        $detector = new SpillDetector($reporter);
        
        // Dispatched 100, received 90
        $manifest = new Manifest('man-1', 100.0, 90.0);

        $detector->detectSpill($manifest);
    }
}
