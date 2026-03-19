<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Cart;

class ShippingValidator
{
    public function isValidForCheckout(Cart $cart): bool
    {
        // The Fix: strictly check for null instead of using loose empty() checks.
        if ($cart->getWeightKg() === null) {
            return false;
        }

        return true;
    }
}
