<?php

declare(strict_types=1);

namespace Marktic\Basket\OrderItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItems;

class OrderItems extends BasketItems
{
    use OrderItemsRepositoryTrait;
    public const TABLE = 'mkt_basket_order_items';
}
