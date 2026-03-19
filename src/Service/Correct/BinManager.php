<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Battery;
use App\Entity\StorageBin;
use DomainException;

class BinManager
{
    public function assignBatteryToBin(Battery $battery, StorageBin $bin): void
    {
        if (($bin->getCurrentWeightKg() + $battery->getWeightKg()) > $bin->getMaxWeightKg()) {
            throw new DomainException('Bin weight capacity exceeded.');
        }

        // The Fix: ensure chemical compatibility
        foreach ($bin->getBatteries() as $existingBattery) {
            if ($existingBattery->getChemicalType() !== $battery->getChemicalType()) {
                throw new DomainException('Cannot mix battery chemical types in the same bin.');
            }
        }
        
        $bin->addBattery($battery);
    }
}
