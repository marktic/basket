<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItemTrait;

/**
 * @property int $cart_id
 */
trait CartItemTrait
{
    use BasketItemTrait;

    public function populateFromBasket($basket): static
    {
        $this->cart_id = $basket->id;
        return $this;
    }
}
