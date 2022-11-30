<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Models;

use Marktic\Basket\Basket\Models\Basket;

class Order extends Basket
{
    use OrderTrait;
}
