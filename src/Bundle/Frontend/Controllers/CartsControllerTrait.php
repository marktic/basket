<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Controllers;

use Marktic\Basket\CartItems\Actions\FindCartItems;
use Marktic\Basket\Carts\Actions\Checkout\CheckoutFromForm;
use Marktic\Basket\PurchasableCatalog\Actions\DetermineCartPaymentMethods;
use Marktic\Basket\Utility\BasketModels;
use Marktic\Pricing\PriceOptions\Actions\FindForSaleable;

trait CartsControllerTrait
{

    public function preview()
    {
        $cart = $this->getCart();
        $cartItems = FindCartItems::for($cart)
            ->withCatalog($this->getBasketCatalog())
            ->fetch();
        if ($cartItems && count($cartItems) < 1) {
            $this->redirect($cart->compileURL('empty'));
        }

        $saleableOptions = FindForSaleable::for($this->getBasketCatalog())->fetch();

        $cartPaymentMethods = DetermineCartPaymentMethods::for($cart)
            ->forTenant($this->getBasketPaymentTenant())
            ->find();

        $form = $cart->getForm('confirm');
        $form->setPaymentMethods($cartPaymentMethods);

        if ($form->execute()) {
            $order = CheckoutFromForm::for($form)->evaluate();

            $redirect = $order->compileURL('confirm');
            $this->flashRedirect(BasketModels::orders()->getMessage('add'), $redirect, 'success', 'orders');
        } else {
			$form->addMessage(BasketModels::carts()->getMessage('preview.info_payment'),'info');
        }

        $this->payload()->with(
            [
                'cart' => $cart,
                'cart_currency' => $saleableOptions->getCurrencyDefaultCode(),
                'cart_currencies' => $saleableOptions->getCurrencyActive(),
                'cItems' => $cartItems,
                'form' => $form,
                'payment_methods' => $cartPaymentMethods,
            ]
        );

//        Assets::entry()->addFromWebpack('registration');
//        $this->populateEventLayout();
    }

    public function empty()
    {

    }

    abstract protected function getCart();

    abstract protected function getBasketPaymentTenant();

    abstract protected function getBasketCatalog();
}

