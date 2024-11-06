<?php

namespace MTubis\Sales\Discount;

use MTubis\Sales\Cart\Cart;

class PercentageDiscount implements DiscountStrategy
{
    private float $threshold;
    private float $percentage;

    public function __construct(float $threshold = 100, float $percentage = 0.10)
    {
        $this->threshold = $threshold;
        $this->percentage = $percentage;
    }

    public function calculateDiscount(Cart $cart): float
    {
        $total = $cart->getTotalAmount();
        return $total >= $this->threshold ? $total * $this->percentage : 0;
    }
}
