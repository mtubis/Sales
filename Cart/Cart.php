<?php

namespace MTubis\Sales\Cart;

class Cart
{
    private array $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getTotalAmount(): float
    {
        return array_sum(array_map(fn($product) => $product->getPrice(), $this->products));
    }

    public function getProductsByType(): array
    {
        $groupedProducts = [];
        foreach ($this->products as $product) {
            $type = $product->getType();
            if (!isset($groupedProducts[$type])) {
                $groupedProducts[$type] = [];
            }
            $groupedProducts[$type][] = $product;
        }
        return $groupedProducts;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
