<?php

declare(strict_types=1);

namespace App\Entity;

class Manifest
{
    public function __construct(
        private readonly string $id,
        private readonly float $dispatchedLiters,
        private readonly float $receivedLiters,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getDispatchedLiters(): float
    {
        return $this->dispatchedLiters;
    }

    public function getReceivedLiters(): float
    {
        return $this->receivedLiters;
    }
}
