<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use Nip\Records\RecordManager;

abstract class Baskets extends RecordManager
{
    use BasketRepositoryTrait;
}
