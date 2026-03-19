<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Subscription;
use App\Repository\SubscriptionRepositoryInterface;
use App\Service\Correct\OverdueSubscriptionHandler;
use PHPUnit\Framework\TestCase;

class OverdueSubscriptionHandlerTest extends TestCase
{
    public function testProcessOverdue_CORRECT(): void
    {
        $repository = $this->createMock(SubscriptionRepositoryInterface::class);
        
        // This subscription is 15 days overdue. Business rule says cancel *exactly* 14 days overdue.
        // We use 'midnight' so it's precisely 15 days difference from 'today' and not 14 days + X hours.
        $subscription = new Subscription('sub-2', new \DateTimeImmutable('-15 days midnight'));
        
        $repository->method('findOverdue')->willReturn([$subscription]);

        $handler = new OverdueSubscriptionHandler($repository);
        $handler->processOverdue();

        // The handler now enforces the exactly 14-days rule, so it will ignore the 15-day sub.
        // Therefore, this PASSES because the status is left untouched.
        $this->assertNotEquals('cancelled', $subscription->getStatus(), 'Should not cancel a subscription that is 15 days overdue.');
    }
}
