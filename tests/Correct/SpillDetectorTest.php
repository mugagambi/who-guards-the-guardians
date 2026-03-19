<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Manifest;
use App\Service\EpaReporterInterface;
use App\Service\Correct\SpillDetector;
use PHPUnit\Framework\TestCase;

class SpillDetectorTest extends TestCase
{
    public function testDetectSpill_CORRECT(): void
    {
        $reporter = $this->createMock(EpaReporterInterface::class);
        
        // 0.8L > 0.5L limit
        $reporter->expects($this->once())->method('reportSpill')->with(0.8);

        $detector = new SpillDetector($reporter);
        
        // Dispatched 100.8, received 100.0
        $manifest = new Manifest('man-2', 100.8, 100.0);

        $detector->detectSpill($manifest);
    }
}
