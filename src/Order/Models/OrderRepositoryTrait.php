<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Models;

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;
use Paytic\Payments\PaymentMethods\ModelsRelated\HasPaymentMethod\HasPaymentMethodRepositoryTrait;

trait OrderRepositoryTrait
{
    use HasPaymentMethodRepositoryTrait;

    protected function generateTable(): string
    {
        return PackageConfig::tableName(BasketModels::ORDERS, Orders::TABLE);
    }

    function relationBasketItemsClass(): string
    {
        return BasketModels::orderItemsClass();
    }

    public function generatePrimaryFK(): string
    {
        return 'order_id';
    }
}
