<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Subscription;

interface SubscriptionRepositoryInterface
{
    /**
     * @return Subscription[]
     */
    public function findOverdue(): array;
}
