<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Cart;
use App\Service\Correct\ShippingValidator;
use PHPUnit\Framework\TestCase;

class ShippingValidatorTest extends TestCase
{
    public function testIsValidForCheckout_CORRECT(): void
    {
        $validator = new ShippingValidator();

        // Digital cart has exactly 0.0 weight.
        $digitalCart = new Cart(50.0, 0.0);

        // Uses loose null-checking, so it correctly accepts 0.0 as a valid weight checkout.
        $this->assertTrue($validator->isValidForCheckout($digitalCart));
    }
}
