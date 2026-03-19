<?php

declare(strict_types=1);

namespace App\Entity;

class Order
{
    private string $status;

    public function __construct(
        private readonly string $id,
        private readonly float $amount,
        string $status = 'paid',
    ) {
        $this->status = $status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
