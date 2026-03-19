<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Repository\SubscriptionRepositoryInterface;
use DateTimeImmutable;

class OverdueSubscriptionHandler
{
    public function __construct(
        private readonly SubscriptionRepositoryInterface $repository
    ) {}

    public function processOverdue(): int
    {
        $overdueSubscriptions = $this->repository->findOverdue();
        $cancelledCount = 0;
        $today = new DateTimeImmutable('today');

        foreach ($overdueSubscriptions as $subscription) {
            // The Fix: Enforce the business rule precisely inside the domain handler
            $differenceText = clone $subscription->getDueDate();
            $difference = $today->diff($differenceText)->days;
            
            if ($difference === 14) {
                $subscription->setStatus('cancelled');
                $cancelledCount++;
            }
        }

        return $cancelledCount;
    }
}
