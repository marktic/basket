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
        $itemsCollection = $this->getSubject()->getItems();
        $basketItem = CreateOrderItem::for($item)->create();
        $itemsCollection->add($basketItem);
        return $this;
    }
}