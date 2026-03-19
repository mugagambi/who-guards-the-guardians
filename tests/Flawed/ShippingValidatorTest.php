<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Cart;
use App\Service\Flawed\ShippingValidator;
use PHPUnit\Framework\TestCase;

class ShippingValidatorTest extends TestCase
{
    public function testIsValidForCheckout_FLAWED(): void
    {
        $validator = new ShippingValidator();

        // Normal physical cart
        $validCart = new Cart(100.0, 5.0);
        $this->assertTrue($validator->isValidForCheckout($validCart));

        // Completely empty cart without items/weight
        $invalidCart = new Cart(0.0, null);
        $this->assertFalse($validator->isValidForCheckout($invalidCart));
    }
}
