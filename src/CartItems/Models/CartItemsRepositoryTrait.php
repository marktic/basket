<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Models;

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;

trait CartItemsRepositoryTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(BasketModels::CART_ITEMS, CartItems::TABLE);
    }
}
