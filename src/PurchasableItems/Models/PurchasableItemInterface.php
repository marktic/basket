<?php

declare(strict_types=1);

namespace Marktic\Basket\PurchasableItems\Models;

use Money\Money;

interface PurchasableItemInterface
{
    public function getBasketCatalog() : ?object;

    public function getPriceMoney($currency = null): Money;
}