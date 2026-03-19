<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Cart;
use App\Entity\User;
use App\Service\Flawed\PromotionApplicator;
use PHPUnit\Framework\TestCase;

class PromotionApplicatorTest extends TestCase
{
    public function testApplyDiscount_FLAWED(): void
    {
        $applicator = new PromotionApplicator();
        $cart = new Cart(100.0);
        $user = new User('user-1', isNew: true);

        $discount = $applicator->applyDiscount($cart, $user);

        // 20% of 100 is 20, which is below the $50 cap.
        // It provides 100% line coverage for the method, but completely misses the unwritten max cap rule.
        $this->assertEquals(20.0, $discount);
    }
}
