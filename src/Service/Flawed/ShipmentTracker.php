<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Entity\Shipment;

class ShipmentTracker
{
    public function updateLocation(Shipment $shipment, string $newLocation): void
    {
        // The bug: Blindly sets state without checking terminal state 'delivered'
        $shipment->setLocation($newLocation);
        $shipment->setStatus('in_transit');
    }
}
