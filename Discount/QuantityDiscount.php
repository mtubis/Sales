<?php

namespace MTubis\Sales\Discount;

use MTubis\Sales\Cart\Cart;

class QuantityDiscount implements DiscountStrategy
{
    public function calculateDiscount(Cart $cart): float
    {
        $discount = 0.0;
        foreach ($cart->getProductsByType() as $products) {
            $quantity = count($products);
            $discount += floor($quantity / 5) * $products[0]->getPrice();
        }
        return $discount;
    }
}
