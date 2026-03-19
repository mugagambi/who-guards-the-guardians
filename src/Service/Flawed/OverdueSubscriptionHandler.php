<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Repository\SubscriptionRepositoryInterface;

class OverdueSubscriptionHandler
{
    public function __construct(
        private readonly SubscriptionRepositoryInterface $repository
    ) {}

    public function processOverdue(): int
    {
        $overdueSubscriptions = $this->repository->findOverdue();
        $cancelledCount = 0;

        foreach ($overdueSubscriptions as $subscription) {
            $subscription->setStatus('cancelled');
            $cancelledCount++;
        }

        return $cancelledCount;
    }
}
