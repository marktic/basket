<?php

declare(strict_types=1);

namespace Marktic\Basket\Carts\Actions\Checkout;

use Marktic\Basket\Bundle\Frontend\Forms\Carts\ConfirmFormTrait;
use Marktic\Basket\Order\Models\Order;

class CheckoutFromForm
{
    /**
     * @var ConfirmFormTrait
     */
    protected $form;

    /**
     * @var Order
     */
    protected $order;

    final protected function __construct($form)
    {
        $this->form = $form;
    }

    public function evaluate()
    {
        $cart = $this->form->getModel();
        $this->order = CheckoutCart::for($cart)->evaluate();
        $this->saveBillingInformation();

        return $this->order;
    }

    /**
     * @param ConfirmFormTrait $form
     *
     * @return self
     */
    public static function for($form): self
    {
        $item = new static($form);

        return $item;
    }

    protected function saveBillingInformation(): void
    {
        return;
//        if (false == $this->form->showBillingForm()) {
//            return;
//        }
//        $cartPaymentMethods = $this->form->getPaymentMethods();
//        $this->form->setModel($this->order);
//        $this->form->setBillingOwner($cartPaymentMethods->first()->getOrganizer());
//        $this->form->saveModelBillingFields();
    }
}