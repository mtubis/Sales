<?php

namespace MTubis\Sales\Cart;

class Product
{
    private string $name;
    private float $price;
    private string $type;

    public function __construct(string $name, float $price, string $type)
    {
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
