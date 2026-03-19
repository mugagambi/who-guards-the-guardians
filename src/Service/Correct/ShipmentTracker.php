<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Shipment;
use DomainException;

class ShipmentTracker
{
    public function updateLocation(Shipment $shipment, string $newLocation): void
    {
        // The Fix: Prevent transition out of terminal state
        if ($shipment->getStatus() === 'delivered') {
            throw new DomainException('Cannot update location of a delivered package.');
        }

        $shipment->setLocation($newLocation);
        $shipment->setStatus('in_transit');
    }
}
