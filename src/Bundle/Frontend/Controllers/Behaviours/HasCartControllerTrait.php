<?php

namespace Marktic\Basket\Bundle\Frontend\Controllers\Behaviours;

use Marktic\Basket\Carts\Actions\FindOrInitCurrentCart;
use Marktic\Basket\Carts\Models\Cart;

trait HasCartControllerTrait
{
    protected $_cart = null;

    protected function getCart(): Cart
    {
        if ($this->_cart === null) {
            $this->_cart = $this->generateCart();
        }
        return $this->_cart;
    }

    protected function generateCart(): Cart
    {
        return FindOrInitCurrentCart::forRequest($this->getRequest())->fetch();
    }
}