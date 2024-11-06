<?php

namespace MTubis\Sales\Discount;

use MTubis\Sales\Cart\Cart;

class DiscountManager
{
    private array $strategies;

    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    public function calculateBestDiscount(Cart $cart): float
    {
        $maxDiscount = 0.0;
        foreach ($this->strategies as $strategy) {
            $discount = $strategy->calculateDiscount($cart);
            if ($discount > $maxDiscount) {
                $maxDiscount = $discount;
            }
        }
        return $maxDiscount;
    }
}
