<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Actions\Checkout;

use Marktic\Basket\Carts\Models\Cart;
use Marktic\Basket\Order\Actions\AddOrderItemToOrder;
use Marktic\Basket\Order\Models\Order;
use Marktic\Basket\OrderItems\Actions\CreateOrderItemFromCartItem;
use Marktic\Basket\OrderItems\Models\OrderItem;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\Record;

class CheckoutCart
{
    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var Order
     */
    protected $order;

    final protected function __construct($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @param Cart $cart
     *
     * @return void
     */
    public static function for($cart): self
    {
        $item = new static($cart);

        return $item;
    }

    public function evaluate()
    {
        $order = $this->createOrder();
        $this->createOrderItems();
        $this->updateCart();

        return $order;
    }

    protected function createOrder(): Record
    {
        $this->order = BasketModels::orders()->getNew();
        $this->order->id_user = $this->cart->id_user;
        $this->order->id_payment_method = $this->cart->id_payment_method;
        $this->order->metadata = $this->cart->metadata;
        $this->order->insert();
        return $this->order;
    }

    protected function createOrderItems(): void
    {
        $cItems = $this->cart->getBasketItems();
        if (count($cItems) < 1) {
            return;
        }
        foreach ($cItems as $cItem) {
            $this->processCartItem($cItem);
            $cItems->remove($cItem);
            $cItem->delete();
        }
    }

    protected function processCartItem($cartItem)
    {
        $this->createOrderItem($cartItem);
    }

    /**
     * @return OrderItem|Record
     */
    public function createOrderItem($cartItem)
    {
        return CreateOrderItemFromCartItem::from($cartItem, $this->order)->create();
    }

    protected function updateCart(): void
    {
        if ($this->cart->id > 0) {
            $this->cart->delete();
        }
    }
}