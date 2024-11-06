<?php

use PHPUnit\Framework\TestCase;
use MTubis\Sales\Cart\Cart;
use MTubis\Sales\Cart\Product;

class CartTest extends TestCase
{
    public function testAddProduct()
    {
        $cart = new Cart();
        $cart->addProduct(new Product('Candy', 10, 'candy'));
        $this->assertCount(1, $cart->getProducts());
    }

    public function testGetTotalAmount()
    {
        $cart = new Cart();
        $cart->addProduct(new Product('Candy', 10, 'candy'));
        $cart->addProduct(new Product('Chocolate', 15, 'chocolate'));
        $this->assertEquals(25, $cart->getTotalAmount());
    }
}
