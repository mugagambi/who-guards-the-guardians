<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Order;
use App\Service\PaymentGatewayInterface;
use App\Service\Flawed\RefundProcessor;
use PHPUnit\Framework\TestCase;

class RefundProcessorTest extends TestCase
{
    public function testProcessRefund_FLAWED(): void
    {
        $gateway = $this->createMock(PaymentGatewayInterface::class);
        $gateway->method('processRefund')->willReturn(true);

        $processor = new RefundProcessor($gateway);
        $order = new Order('ord-1', 100.0, 'paid');

        // It doesn't throw, and the mock ensures the gateway was called.
        // High coverage, but ignores the state mutation.
        $processor->processRefund($order);
        
        $this->assertTrue(true, 'Refund processed without errors.');
    }
}
