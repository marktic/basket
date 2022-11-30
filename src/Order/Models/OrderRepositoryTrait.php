<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Models;

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;

trait OrderRepositoryTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(BasketModels::ORDERS, Orders::TABLE);
    }
}
