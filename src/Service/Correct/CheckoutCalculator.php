<?php

declare(strict_types=1);

namespace App\Service\Correct;

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

        // The Fix: Always apply Fixed before Percentage to prevent over-discounting
        usort($vouchers, function ($a, $b) {
            if ($a->getType() === $b->getType()) return 0;
            return $a->getType() === 'fixed' ? -1 : 1;
        });

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
