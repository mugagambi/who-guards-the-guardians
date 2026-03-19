<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Order;
use App\Service\PaymentGatewayInterface;
use App\Service\Correct\RefundProcessor;
use LogicException;
use PHPUnit\Framework\TestCase;

class RefundProcessorTest extends TestCase
{
    public function testProcessRefund_CORRECT(): void
    {
        $gateway = $this->createMock(PaymentGatewayInterface::class);
        $gateway->method('processRefund')->willReturn(true);

        $processor = new RefundProcessor($gateway);
        $order = new Order('ord-2', 50.0, 'paid');

        // First refund goes through.
        $processor->processRefund($order);

        $this->expectException(LogicException::class);
        
        // Second refund correctly triggers an exception because state was mutated properly.
        $processor->processRefund($order);
    }
}
