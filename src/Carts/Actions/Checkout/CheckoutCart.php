<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Actions\Checkout;

use Marktic\Basket\Carts\Events\Checkout\CheckoutOrderProcessedEvent;
use Marktic\Basket\Carts\Events\Checkout\CheckoutStartEvent;
use Marktic\Basket\Carts\Models\Cart;
use Marktic\Basket\CartItems\Models\CartItem;
use Marktic\Basket\Order\Actions\AddOrderItemToOrder;
use Marktic\Basket\Order\Models\Order;
use Marktic\Basket\OrderItems\Actions\CreateOrderItemFromCartItem;
use Marktic\Basket\OrderItems\Models\OrderItem;
use Marktic\Basket\Utility\BasketModels;

class CheckoutCart
{
    /**
     * @var Cart
     */
    protected Cart $cart;

    /**
     * @var Order|null
     */
    protected ?Order $order = null;

    final protected function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @param Cart $cart
     *
     * @return static
     */
    public static function for(Cart $cart): static
    {
        $item = new static($cart);

        return $item;
    }

    public function evaluate(): Order
    {
        CheckoutStartEvent::dispatch($this->cart);

        $order = $this->createOrder();
        $this->createOrderItems();
        $this->updateCart();

        CheckoutOrderProcessedEvent::dispatch($this->order);
        return $order;
    }

    protected function createOrder(): Order
    {
        $this->order = BasketModels::orders()->getNew();
        $this->order->id_user = $this->cart->id_user;
        $this->order->id_payment_method = $this->cart->id_payment_method;
        $this->order->currency_code = $this->cart->getCurrency();
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

    protected function processCartItem(CartItem $cartItem): void
    {
        $this->createOrderItem($cartItem);
    }

    /**
     * @return OrderItem
     */
    public function createOrderItem(CartItem $cartItem): OrderItem
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