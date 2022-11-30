<?php

declare(strict_types=1);

namespace Marktic\Basket\Cart\Models;

use Marktic\Basket\Basket\Models\Baskets;

class Carts extends Baskets
{
    use CartRepositoryTrait;
    public const TABLE = 'mkt_basket_carts';
}
