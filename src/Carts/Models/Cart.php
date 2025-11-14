<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Models;

use Marktic\Basket\Basket\Models\Basket;

/**
 * @property string $uuid
 */
class Cart extends Basket
{
    use CartTrait;
}
