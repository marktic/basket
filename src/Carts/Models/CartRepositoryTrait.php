<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Models;

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;

trait CartRepositoryTrait
{
    protected function generateTable(): string
    {
        return PackageConfig::tableName(BasketModels::CARTS, Carts::TABLE);
    }

    function relationBasketItemsClass(): string
    {
        return BasketModels::cartItemsClass();
    }

    public function generatePrimaryFK()
    {
        return 'cart_id';
    }

}
