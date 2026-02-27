<?php

class ArticleDTO
{
    public string $name;
    public float $price;
    public array $gallery;
    public int $stock;

    public function __construct(string $name, float $price, array $gallery = [], int $stock = 0)
    {
        $this->name = $name;
        $this->price = $price;
        $this->gallery = $gallery;
        $this->stock = $stock;
    }
}