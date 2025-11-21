<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Actions;

use ByTIC\Money\Utility\Money;
use Marktic\Basket\Base\Actions\BaseCalculator;
use Marktic\Basket\BasketItems\Models\BasketItem;

/**
 * @method BasketItem getSubject()
 */
class BasketItemCalculator extends BaseCalculator
{
    protected function calculateSubTotal(): int
    {
        $basketItem = $this->getSubject();
        $quantity = $basketItem->getQuantity();
        $basketProduct = $basketItem->getBasketProduct();
        $unitPrice = $basketProduct->getPriceMoney($this->currency);
        $total = $unitPrice->multiply($quantity);
        return $total->toCents();
    }
}

