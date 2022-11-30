<?php

namespace Marktic\Basket\Cart\Models;

use Marktic\Basket\Basket\Models\Baskets;

class Carts extends Baskets
{
    public const TABLE = 'mkt_basket_carts';

    use CartRepositoryTrait;
}