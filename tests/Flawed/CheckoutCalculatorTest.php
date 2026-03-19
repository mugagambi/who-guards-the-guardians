<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Cart;
use App\Entity\Voucher;
use App\Service\Flawed\CheckoutCalculator;
use PHPUnit\Framework\TestCase;

class CheckoutCalculatorTest extends TestCase
{
    public function testCalculateTotal_FLAWED(): void
    {
        $calculator = new CheckoutCalculator();
        $cart = new Cart(100.0);
        
        // Testing fixed and percentage separately, which works perfectly.
        $fixedDiscount = $calculator->calculateTotal($cart, [new Voucher('fixed', 10.0)]);
        $this->assertEquals(90.0, $fixedDiscount);

        $percentageDiscount = $calculator->calculateTotal($cart, [new Voucher('percentage', 10.0)]);
        $this->assertEquals(90.0, $percentageDiscount);
    }
}
