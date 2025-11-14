<?php

declare(strict_types=1);

namespace Marktic\Basket\PurchasableItems\Models;

interface PurchasableItemInterface
{
    public function getBasketCatalog() : ?object;
}