<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use Nip\Records\Record;

abstract class Basket extends Record
{
    use BasketTrait;
}
