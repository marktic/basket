<?php

declare(strict_types=1);

namespace Marktic\Basket\OrderItems\Actions;

use Marktic\Basket\BasketItems\Actions\CreateBasketItem;
use Marktic\Basket\CartItems\Models\CartItem;
use Marktic\Basket\OrderItems\Models\OrderItem;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 * @property OrderItem $resultRecord
 */
class CreateOrderItemFromCartItem extends CreateBasketItem
{

    /**
     * @param CartItem $cartItem
     * @return static
     */
    public static function from($cartItem, $order): static
    {
        $action = self::for($cartItem->getBasketProduct(), $order);
        $action->withQuantity($cartItem->quantity);
        $action->withMetadata($cartItem->metadata);
        return $action;
    }

    protected function generateRepository(): RecordManager
    {
        return BasketModels::orderItems();
    }
}