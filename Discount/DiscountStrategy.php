<?php

namespace MTubis\Sales\Discount;

use MTubis\Sales\Cart\Cart;

interface DiscountStrategy
{
    public function calculateDiscount(Cart $cart): float;
}
