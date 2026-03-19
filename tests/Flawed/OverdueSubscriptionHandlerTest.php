<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Subscription;
use App\Repository\SubscriptionRepositoryInterface;
use App\Service\Flawed\OverdueSubscriptionHandler;
use PHPUnit\Framework\TestCase;

class OverdueSubscriptionHandlerTest extends TestCase
{
    public function testProcessOverdue_FLAWED(): void
    {
        $repository = $this->createMock(SubscriptionRepositoryInterface::class);
        $subscription = new Subscription('sub-1', new \DateTimeImmutable('-15 days'));
        
        $repository->method('findOverdue')->willReturn([$subscription]);

        $handler = new OverdueSubscriptionHandler($repository);
        $count = $handler->processOverdue();

        $this->assertEquals(1, $count);
        $this->assertEquals('cancelled', $subscription->getStatus());
    }
}
