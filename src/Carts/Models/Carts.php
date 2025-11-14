<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Models;

use Marktic\Basket\Basket\Models\Baskets;
use Marktic\Basket\Utility\BasketModels;

/**
 * @method Cart findOneByField
 * @method Cart getNew
 */
class Carts extends Baskets
{
    use CartRepositoryTrait;
    public const TABLE = 'mkt_basket_carts';


}
