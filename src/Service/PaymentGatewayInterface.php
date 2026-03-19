<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;

interface PaymentGatewayInterface
{
    public function processRefund(Order $order): bool;
}
