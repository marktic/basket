<?php

declare(strict_types=1);

namespace Marktic\Basket\OrderItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItemsRepositoryTrait;
use Marktic\Basket\CartItems\Models\CartItems;
use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;

trait OrderItemsRepositoryTrait
{
    use BasketItemsRepositoryTrait;
    protected function generateTable(): string
    {
        return PackageConfig::tableName(BasketModels::ORDER_ITEMS, CartItems::TABLE);
    }
}
