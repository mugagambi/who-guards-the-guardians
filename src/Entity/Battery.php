<?php

declare(strict_types=1);

namespace App\Entity;

class Battery
{
    public function __construct(
        private readonly string $id,
        private readonly string $chemicalType,
        private readonly float $weightKg,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getChemicalType(): string
    {
        return $this->chemicalType;
    }

    public function getWeightKg(): float
    {
        return $this->weightKg;
    }
}
