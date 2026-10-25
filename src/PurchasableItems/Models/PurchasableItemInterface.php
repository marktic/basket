<?php

declare(strict_types=1);

namespace Marktic\Basket\PurchasableItems\Models;

use \ByTIC\Money\Money;
use Money\Currency;

interface PurchasableItemInterface
{
    public function getBasketCatalog() : ?object;

    public function getPriceMoney(string|Currency|null $currency = null): Money;
}