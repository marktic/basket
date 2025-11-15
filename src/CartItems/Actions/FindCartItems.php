<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Actions;

use Marktic\Basket\BasketItems\Actions\FindBasketItems;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;

class FindCartItems extends FindBasketItems
{
    protected function generateRepository(): RecordManager
    {
        return BasketModels::cartItems();
    }
}
