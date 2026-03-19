<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Entity\Cart;
use App\Entity\Voucher;

class CheckoutCalculator
{
    /**
     * @param Voucher[] $vouchers
     */
    public function calculateTotal(Cart $cart, array $vouchers): float
    {
        $total = $cart->getSubtotal();

        // The bug: Apply vouchers in the order provided, instead of fixing order (Fixed first, then Percentage)
        foreach ($vouchers as $voucher) {
            if ($voucher->getType() === 'fixed') {
                $total -= $voucher->getValue();
            } elseif ($voucher->getType() === 'percentage') {
                $total -= ($total * ($voucher->getValue() / 100));
            }
        }

        return max(0.0, $total);
    }
}
