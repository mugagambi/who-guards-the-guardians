<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

class Subscription
{
    private string $status;

    public function __construct(
        private readonly string $id,
        private readonly DateTimeImmutable $dueDate,
        string $status = 'active',
    ) {
        $this->status = $status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->dueDate;
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
