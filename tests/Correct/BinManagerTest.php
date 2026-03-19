<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Battery;
use App\Entity\StorageBin;
use App\Service\Correct\BinManager;
use DomainException;
use PHPUnit\Framework\TestCase;

class BinManagerTest extends TestCase
{
    public function testAssignBatteryToBin_CORRECT(): void
    {
        $manager = new BinManager();
        $bin = new StorageBin('bin-2', 100.0);

        // Mix: lithium-ion and lead-acid
        $battery1 = new Battery('bat-1', 'lithium-ion', 10.0);
        $manager->assignBatteryToBin($battery1, $bin);

        $battery2 = new Battery('bat-2', 'lead-acid', 10.0);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Cannot mix battery chemical types');
        
        $manager->assignBatteryToBin($battery2, $bin);
    }
}
