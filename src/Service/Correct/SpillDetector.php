<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Manifest;
use App\Service\EpaReporterInterface;

class SpillDetector
{
    public function __construct(
        private readonly EpaReporterInterface $reporter,
    ) {}

    public function detectSpill(Manifest $manifest): void
    {
        // The Fix: Keep float precision
        $dispatched = $manifest->getDispatchedLiters();
        $received = $manifest->getReceivedLiters();

        $difference = round($dispatched - $received, 2);

        if ($difference > 0.5) {
            $this->reporter->reportSpill($difference);
        }
    }
}
