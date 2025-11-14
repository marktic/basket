<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Actions;

use Marktic\Basket\BasketItems\Actions\CreateBasketItem;
use Marktic\Basket\OrderItems\Models\OrderItem;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 * @property OrderItem $resultRecord
 */
class CreateCartItem extends CreateBasketItem
{

    protected function generateRepository(): RecordManager
    {
        return BasketModels::orderItems();
    }
}