<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Entity\Battery;
use App\Entity\StorageBin;

class BinManager
{
    public function assignBatteryToBin(Battery $battery, StorageBin $bin): void
    {
        if (($bin->getCurrentWeightKg() + $battery->getWeightKg()) > $bin->getMaxWeightKg()) {
            throw new \DomainException('Bin weight capacity exceeded.');
        }

        // The bug: Forgets to check chemical compatibility of existing batteries
        
        $bin->addBattery($battery);
    }
}
