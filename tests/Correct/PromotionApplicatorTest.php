<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Cart;
use App\Entity\User;
use App\Service\Correct\PromotionApplicator;
use PHPUnit\Framework\TestCase;

class PromotionApplicatorTest extends TestCase
{
    public function testApplyDiscount_CORRECT(): void
    {
        $applicator = new PromotionApplicator();
        $cart = new Cart(1000.0);
        $user = new User('user-2', isNew: true);

        $discount = $applicator->applyDiscount($cart, $user);

        // 20% of 1000 is 200, which should be capped at $50.
        // The Correct service properly handles this business rule, so this PASSES.
        $this->assertEquals(50.0, $discount);
    }
}
