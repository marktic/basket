<?php

declare(strict_types=1);

use Marktic\Basket\Cart\Models\Carts;
use Marktic\Basket\Order\Models\Orders;
use Marktic\Basket\Utility\BasketModels;

return [
    'models' => [
        BasketModels::CARTS => Carts::class,
        BasketModels::ORDERS => Orders::class,
    ],
    'tables' => [
        BasketModels::CARTS => Carts::TABLE,
        BasketModels::ORDERS => Orders::TABLE,
    ],
    'database' => [
        'connection' => 'main',
        'migrations' => true,
    ],
];
