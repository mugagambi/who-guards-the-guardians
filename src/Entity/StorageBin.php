<?php

declare(strict_types=1);

namespace App\Entity;

class StorageBin
{
    /** @var Battery[] */
    private array $batteries = [];

    public function __construct(
        private readonly string $id,
        private readonly float $maxWeightKg,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getMaxWeightKg(): float
    {
        return $this->maxWeightKg;
    }

    public function addBattery(Battery $battery): void
    {
        $this->batteries[] = $battery;
    }

    /** @return Battery[] */
    public function getBatteries(): array
    {
        return $this->batteries;
    }

    public function getCurrentWeightKg(): float
    {
        return array_sum(array_map(fn(Battery $b) => $b->getWeightKg(), $this->batteries));
    }
}
