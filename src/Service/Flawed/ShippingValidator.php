<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Entity\Cart;

class ShippingValidator
{
    public function isValidForCheckout(Cart $cart): bool
    {
        // The bug: empty() evaluates 0.0 as true (empty), invalidating purely digital carts
        if (empty($cart->getWeightKg())) {
            return false;
        }

        return true;
    }
}
