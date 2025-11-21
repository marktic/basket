<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Actions;


use ByTIC\Money\Utility\Money;
use Marktic\Basket\Base\Actions\BaseCalculator;
use Marktic\Basket\BasketItems\Actions\BasketItemCalculator;

class BasketCalculator extends BaseCalculator
{
    protected function calculateSubTotal() : int
    {
        $total = Money::fromCents(0, $this->currency);
        $items = $this->getSubject()->getItems();
        foreach ($items as $item) {
            $itemCalculator = BasketItemCalculator::forCurrency($item, $this->currency);
            $total->add($itemCalculator->getTotalMoney());
        }
        return $total->toCents();
    }
}

