<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Models;

use Marktic\Basket\Basket\Models\Baskets;

class Orders extends Baskets
{
    use OrderRepositoryTrait;
    public const TABLE = 'mkt_basket_orders';
}
