<?php

use PHPUnit\Framework\TestCase;
use MTubis\Sales\Cart\Cart;
use MTubis\Sales\Cart\Product;
use MTubis\Sales\Discount\DiscountManager;
use MTubis\Sales\Discount\PercentageDiscount;
use MTubis\Sales\Discount\QuantityDiscount;

class DiscountManagerTest extends TestCase
{
    public function testCalculateBestDiscount()
    {
        $cart = new Cart();
        for ($i = 0; $i < 5; $i++) {
            $cart->addProduct(new Product('Candy', 10, 'candy'));
        }
        $cart->addProduct(new Product('Chocolate', 15, 'chocolate'));

        $discountManager = new DiscountManager([
            new QuantityDiscount(),
            new PercentageDiscount(),
        ]);

        $this->assertEquals(10, $discountManager->calculateBestDiscount($cart));
    }
}