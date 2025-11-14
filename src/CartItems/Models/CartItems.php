<?php

declare(strict_types=1);

namespace Marktic\Basket\CartItems\Models;

use Marktic\Basket\BasketItems\Models\BasketItems;

class CartItems extends BasketItems
{
    use CartItemsRepositoryTrait;

    public const TABLE = 'mkt_basket_cart_items';
    public const CONTROLLER = 'mkt_basket-cart_items';

    protected function generateController(): string
    {
        return self::CONTROLLER;
    }
}
