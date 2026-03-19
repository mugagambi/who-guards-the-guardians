<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Cart;
use App\Entity\Voucher;
use App\Service\Correct\CheckoutCalculator;
use PHPUnit\Framework\TestCase;

class CheckoutCalculatorTest extends TestCase
{
    public function testCalculateTotal_CORRECT(): void
    {
        $calculator = new CheckoutCalculator();
        $cart = new Cart(100.0);
        
        // We pass percentage first, then fixed.
        // Correct order of operations dictates fixed MUST be applied first to prevent over-discounting.
        $vouchers = [
            new Voucher('percentage', 10.0),
            new Voucher('fixed', 10.0),
        ];

        $total = $calculator->calculateTotal($cart, $vouchers);

        // The fixed component properly sorts it, so this expectation PASSES.
        $this->assertEquals(81.0, $total);
    }
}
