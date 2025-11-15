<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Controllers;

use Marktic\Basket\BasketItems\Actions\FindBasketItems;
use Marktic\Basket\PurchasableCatalog\Actions\DetermineCartPaymentMethods;

trait CartControllerTrait
{

    public function preview()
    {
        $cart = $this->getCart();
        $cartItems = FindBasketItems::for($cart)->withCatalog($this->getBasketCatalog());
        if ($cartItems && count($cartItems) < 1) {
            $this->redirect($cart->compileURL('empty'));
        }

        $cartPaymentMethods = DetermineCartPaymentMethods::for($cart)
            ->forTenant($this->getBasketPaymentTenant())
            ->find();

//        $form = $eventCart->getForm('confirm');
//        $form->setEvent($cartEvent);
//        $form->setPaymentMethods($cartPaymentMethods);

//        if ($form->execute()) {
//            $order = CheckoutFromForm::for($form)->evaluate();
//
//            $redirect = $order->compileURL('confirm');
//            $this->flashRedirect(ModelLocator::orders()->getMessage('add'), $redirect, 'success', 'orders');
//        } else {
//			$form->addMessage(\KM42\Register\Library\Records\Locator\ModelLocator::carts()->getMessage('preview.info_payment'),'info');
//        }

        $this->payload()->with(
            [
                'cart' => $cart,
                'cItems' => $cartItems,
//                'form' => $form,
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

