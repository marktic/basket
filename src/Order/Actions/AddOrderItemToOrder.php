<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\Order\Models\Order;
use Marktic\Basket\OrderItems\Actions\CreateOrderItem;
use Marktic\Basket\PurchasableItems\Models\PurchasableItemInterface;

/**
 * @method Order getSubject()
 */
class AddOrderItemToOrder extends Action
{
    use HasSubject;

    public function addItem(PurchasableItemInterface $item)
    {
        $basket = $this->getSubject();
        $itemsCollection = $basket->getBasketItems();
        $basketItem = CreateOrderItem::for($item, $basket)->create();
        $itemsCollection->add($basketItem);
        return $this;
    }
}