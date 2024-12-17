<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

use Nip\Records\RecordManager;

abstract class BasketItems extends RecordManager
{
    use BasketItemsRepositoryTrait;
}
