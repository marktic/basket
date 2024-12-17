<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

use Nip\Records\Record;

abstract class BasketItem extends Record
{
    use BasketItemTrait;
}
