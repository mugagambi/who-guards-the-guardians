<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Battery;
use App\Entity\StorageBin;
use App\Service\Flawed\BinManager;
use DomainException;
use PHPUnit\Framework\TestCase;

class BinManagerTest extends TestCase
{
    public function testAssignBatteryToBin_FLAWED(): void
    {
        $manager = new BinManager();
        $bin = new StorageBin('bin-1', 100.0);

        // Success: adding to empty bin
        $battery = new Battery('bat-1', 'lithium-ion', 50.0);
        $manager->assignBatteryToBin($battery, $bin);
        $this->assertCount(1, $bin->getBatteries());

        // Exception: adding to full bin
        $heavyBattery = new Battery('bat-2', 'lead-acid', 60.0);
        
        $this->expectException(DomainException::class);
        $manager->assignBatteryToBin($heavyBattery, $bin);
    }
}
