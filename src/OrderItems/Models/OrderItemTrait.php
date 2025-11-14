<?php

declare(strict_types=1);

namespace Marktic\Basket\OrderItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItemTrait;

/**
 * @property int $order_id
 */
trait OrderItemTrait
{
    use BasketItemTrait;

    public function populateFromBasket($basket): static
    {
        $this->order_id = $basket->id;
        return $this;
    }
}
