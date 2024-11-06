<?php

use PHPUnit\Framework\TestCase;
use MTubis\Sales\Cart\Cart;
use MTubis\Sales\Cart\Product;
use MTubis\Sales\Discount\QuantityDiscount;

class QuantityDiscountTest extends TestCase
{
    public function testNoDiscountForLessThanFiveSameTypeProducts()
    {
        $cart = new Cart();
        for ($i = 0; $i < 4; $i++) {
            $cart->addProduct(new Product('Candy', 10, 'candy'));
        }

        $discount = new QuantityDiscount();
        $this->assertEquals(0, $discount->calculateDiscount($cart));
    }

    public function testDiscountForEveryFifthProductOfSameType()
    {
        $cart = new Cart();
        for ($i = 0; $i < 5; $i++) {
            $cart->addProduct(new Product('Candy', 10, 'candy'));
        }

        $discount = new QuantityDiscount();
        $expectedDiscount = 10; // Jeden darmowy produkt
        $this->assertEquals($expectedDiscount, $discount->calculateDiscount($cart));
    }

    public function testDiscountWithMultipleEligibleGroups()
    {
        $cart = new Cart();
        for ($i = 0; $i < 10; $i++) {
            $cart->addProduct(new Product('Candy', 10, 'candy'));
        }

        $discount = new QuantityDiscount();
        $expectedDiscount = 20; // Dwa darmowe produkty
        $this->assertEquals($expectedDiscount, $discount->calculateDiscount($cart));
    }

    public function testDiscountForDifferentProductTypes()
    {
        $cart = new Cart();
        for ($i = 0; $i < 5; $i++) {
            $cart->addProduct(new Product('Candy', 10, 'candy'));
        }
        for ($i = 0; $i < 5; $i++) {
            $cart->addProduct(new Product('Chocolate', 15, 'chocolate'));
        }

        $discount = new QuantityDiscount();
        $expectedDiscount = 10 + 15; // Jeden darmowy produkt z każdej grupy
        $this->assertEquals($expectedDiscount, $discount->calculateDiscount($cart));
    }
}