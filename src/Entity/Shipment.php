<?php

declare(strict_types=1);

namespace App\Entity;

class Shipment
{
    private string $status;
    private string $location;

    public function __construct(
        private readonly string $id,
        string $status = 'dispatched',
        string $location = 'Warehouse A',
    ) {
        $this->status = $status;
        $this->location = $location;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
}
