<?php

declare(strict_types=1);

namespace Marktic\Basket\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use Marktic\Basket\BasketServiceProvider;
use Marktic\Basket\Carts\Models\Carts;
use Marktic\Basket\CartItems\Models\CartItems;
use Marktic\Basket\Order\Models\Orders;
use Marktic\Basket\OrderItems\Models\OrderItems;
use Nip\Records\RecordManager;

/**
 * Class BasketModels.
 */
class BasketModels extends ModelFinder
{
    public const CARTS = 'carts';

    public const CART_ITEMS = 'cart_items';
    public const ORDERS = 'orders';

    public const ORDER_ITEMS = 'order_items';

    public static function carts(): Carts|RecordManager
    {
        return static::getModels(self::CARTS, Carts::class);
    }

    public static function cartItems()
    {
       return static::getModels(self::CART_ITEMS, CartItems::class);
    }

    public static function cartItemsClass()
    {
       return get_class(static::cartItems());
    }

    /**
     * @return Orders|RecordManager
     */
    public static function orders(): Carts|RecordManager
    {
        return static::getModels(self::ORDERS, Orders::class);
    }

    public static function orderItems()
    {
        return static::getModels(self::ORDER_ITEMS, OrderItems::class);
    }


    public static function orderItemsClass(): string
    {
        return get_class(static::orderItems());
    }

    protected static function packageName(): string
    {
        return BasketServiceProvider::NAME;
    }
}
