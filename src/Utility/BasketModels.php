<?php

declare(strict_types=1);

namespace Marktic\Basket\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use Marktic\Basket\BasketServiceProvider;
use Marktic\Basket\Cart\Models\Carts;
use Marktic\Basket\Order\Models\Orders;
use Nip\Records\RecordManager;

/**
 * Class BasketModels.
 */
class BasketModels extends ModelFinder
{
    public const CARTS = 'carts';
    public const ORDERS = 'orders';

    public static function carts(): Carts|RecordManager
    {
        return static::getModels(self::CARTS, Carts::class);
    }

    /**
     * @return Orders|RecordManager
     */
    public static function orders(): Carts|RecordManager
    {
        return static::getModels(self::ORDERS, Orders::class);
    }

    protected static function packageName(): string
    {
        return BasketServiceProvider::NAME;
    }
}
