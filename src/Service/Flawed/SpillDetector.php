<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Entity\Manifest;
use App\Service\EpaReporterInterface;

class SpillDetector
{
    public function __construct(
        private readonly EpaReporterInterface $reporter,
    ) {}

    public function detectSpill(Manifest $manifest): void
    {
        // The bug: uses intval, destroying the decimal floating point data
        $dispatched = intval($manifest->getDispatchedLiters());
        $received = intval($manifest->getReceivedLiters());

        $difference = $dispatched - $received;

        if ($difference > 0.5) {
            $this->reporter->reportSpill((float) $difference);
        }
    }
}
