<?php

class SortUtils
{
    public static function sortByPrice(array $items, ?string $sortType = null): array
    {
        if ($sortType === 'priceAsc') {
            usort($items, fn($a, $b) => $a['price'] <=> $b['price']);
        } elseif ($sortType === 'priceDesc') {
            usort($items, fn($a, $b) => $b['price'] <=> $a['price']);
        }

        return $items;
    }
}