<?php

declare(strict_types=1);

namespace Marktic\Basket\OrderItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItem;

class OrderItem extends BasketItem
{
    use OrderItemTrait;

}
