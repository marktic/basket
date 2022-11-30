<?php

namespace Marktic\Basket\Cart\Models;

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;

trait CartRepositoryTrait
{

    protected function generateTable(): string
    {
        return PackageConfig::tableName(BasketModels::CARTS, Carts::TABLE);
    }
}
