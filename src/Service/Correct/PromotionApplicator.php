<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Cart;
use App\Entity\User;

class PromotionApplicator
{
    public function applyDiscount(Cart $cart, User $user): float
    {
        $discount = 0.0;

        if ($user->isNew()) {
            $discount = $cart->getSubtotal() * 0.20;
        }

        // The Fix: Enforce the maximum $50 cap
        if ($discount > 50.0) {
            $discount = 50.0;
        }

        return $discount;
    }
}
