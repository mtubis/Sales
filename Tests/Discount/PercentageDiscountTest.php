<?php

use PHPUnit\Framework\TestCase;
use MTubis\Sales\Cart\Cart;
use MTubis\Sales\Cart\Product;
use MTubis\Sales\Discount\PercentageDiscount;

class PercentageDiscountTest extends TestCase
{
    public function testNoDiscountBelowThreshold()
    {
        $cart = new Cart();
        $cart->addProduct(new Product('Candy', 50, 'candy'));
        $cart->addProduct(new Product('Chocolate', 40, 'chocolate'));

        $discount = new PercentageDiscount();
        $this->assertEquals(0, $discount->calculateDiscount($cart));
    }

    public function testDiscountAppliedWhenThresholdExceeded()
    {
        $cart = new Cart();
        $cart->addProduct(new Product('Candy', 60, 'candy'));
        $cart->addProduct(new Product('Chocolate', 50, 'chocolate'));

        $discount = new PercentageDiscount();
        $expectedDiscount = (60 + 50) * 0.10; // 10% zniżki powyżej 100 zł
        $this->assertEquals($expectedDiscount, $discount->calculateDiscount($cart));
    }

    public function testCustomThresholdAndPercentage()
    {
        $cart = new Cart();
        $cart->addProduct(new Product('Candy', 200, 'candy'));

        $discount = new PercentageDiscount(150, 0.20); // niestandardowy próg 150 zł, 20% rabatu
        $expectedDiscount = 200 * 0.20;
        $this->assertEquals($expectedDiscount, $discount->calculateDiscount($cart));
    }
}