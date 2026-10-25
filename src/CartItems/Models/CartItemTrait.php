<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItemTrait;
use Nip\Records\AbstractModels\Record;

/**
 * @property int $cart_id
 */
trait CartItemTrait
{
    use BasketItemTrait;

    public function populateFromBasket(Record $basket): static
    {
        $this->cart_id = $basket->id;
        return $this;
    }
}
