<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Shipment;
use App\Service\Correct\ShipmentTracker;
use DomainException;
use PHPUnit\Framework\TestCase;

class ShipmentTrackerTest extends TestCase
{
    public function testUpdateLocation_CORRECT(): void
    {
        $tracker = new ShipmentTracker();
        
        $shipment = new Shipment('ship-2', 'delivered', 'Customer Address');

        $this->expectException(DomainException::class);

        // Firing this will correctly throw because the logic is fixed.
        $tracker->updateLocation($shipment, 'Lost in Mail');
    }
}
