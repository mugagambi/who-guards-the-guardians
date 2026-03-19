<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Shipment;
use App\Service\Flawed\ShipmentTracker;
use PHPUnit\Framework\TestCase;

class ShipmentTrackerTest extends TestCase
{
    public function testUpdateLocation_FLAWED(): void
    {
        $tracker = new ShipmentTracker();
        $shipment = new Shipment('ship-1', 'dispatched', 'Warehouse A');

        $tracker->updateLocation($shipment, 'Sorting Center');

        $this->assertEquals('in_transit', $shipment->getStatus());
        $this->assertEquals('Sorting Center', $shipment->getLocation());
    }
}
