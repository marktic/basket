<?php

declare(strict_types=1);

use Marktic\Basket\Cart\Models\Carts;
use Marktic\Basket\CartItems\Models\CartItems;
use Marktic\Basket\Order\Models\Orders;
use Marktic\Basket\OrderItems\Models\OrderItems;
use Marktic\Basket\Utility\BasketModels;

return [
    'models' => [
        BasketModels::CARTS => Carts::class,
        BasketModels::CART_ITEMS => CartItems::class,
        BasketModels::ORDERS => Orders::class,
        BasketModels::ORDER_ITEMS => OrderItems::class,
    ],
    'tables' => [
        BasketModels::CARTS => Carts::TABLE,
        BasketModels::CART_ITEMS => CartItems::TABLE,
        BasketModels::ORDERS => Orders::TABLE,
        BasketModels::ORDER_ITEMS => OrderItems::TABLE,
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
