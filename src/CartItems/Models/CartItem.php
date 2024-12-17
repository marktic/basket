<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItem;

class CartItem extends BasketItem
{
    use CartItemTrait;
}
