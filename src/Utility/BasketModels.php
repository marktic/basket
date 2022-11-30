<?php

namespace Marktic\Basket\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use Marktic\Basket\Cart\Models\Carts;
use Marktic\Basket\Order\Models\Orders;
use Marktic\Basket\BasketServiceProvider;
use Nip\Records\RecordManager;

/**
 * Class BasketModels
 * @package Marktic\Basket\Utility
 */
class BasketModels extends ModelFinder
{
    public const CARTS = 'carts';
    public const ORDERS = 'orders';

    /**
     * @return Carts|RecordManager
     */
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
