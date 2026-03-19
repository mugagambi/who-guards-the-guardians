<?php

declare(strict_types=1);

namespace App\Entity;

class User
{
    public function __construct(
        private readonly string $id,
        private readonly bool $isNew = false,
        private readonly bool $isFriend = false,
        private readonly bool $isBlocked = false,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }

    public function isFriend(): bool
    {
        return $this->isFriend;
    }

    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }
}
