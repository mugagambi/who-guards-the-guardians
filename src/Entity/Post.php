<?php

declare(strict_types=1);

namespace App\Entity;

class Post
{
    public function __construct(
        private readonly string $id,
        private readonly bool $isPublic = true,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }
}
