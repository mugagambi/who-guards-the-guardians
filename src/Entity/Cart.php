<?php

declare(strict_types=1);

namespace App\Entity;

class Cart
{
    public function __construct(
        private readonly float $subtotal,
        private readonly ?float $weightKg = null,
    ) {}

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function getWeightKg(): ?float
    {
        return $this->weightKg;
    }
}
