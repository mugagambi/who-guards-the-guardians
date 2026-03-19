<?php

declare(strict_types=1);

namespace App\Entity;

class IrregularityLog
{
    public function __construct(
        private readonly string $id,
        private readonly int $year,
        private readonly string $description,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
