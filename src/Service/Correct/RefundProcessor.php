<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Order;
use App\Service\PaymentGatewayInterface;
use LogicException;

class RefundProcessor
{
    public function __construct(
        private readonly PaymentGatewayInterface $paymentGateway,
    ) {}

    public function processRefund(Order $order): void
    {
        if ($order->getStatus() === 'refunded') {
            throw new LogicException('Order has already been refunded.');
        }

        if ($order->getStatus() === 'paid') {
            $success = $this->paymentGateway->processRefund($order);
            
            if ($success) {
                // The Fix: proper state mutation
                $order->setStatus('refunded');
            }
        }
    }
}
