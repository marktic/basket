<?php

namespace Marktic\Basket\Order\Models;

use Marktic\Basket\Basket\Models\Baskets;

class Orders extends Baskets
{
    public const TABLE = 'mkt_basket_orders';

    use OrderRepositoryTrait;
}