<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Forms\Carts;

use Marktic\Basket\Carts\Models\Cart;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\Collections\Collection;
use Paytic\Payments\Models\Methods\PaymentMethod;
use Paytic\Payments\Utility\PaymentsModels;

/**
 * @method Cart getModel()
 */
trait ConfirmFormTrait
{

    protected $showPaymentMethods = true;

    protected $paymentMethods = null;

    protected $currency = null;
    public function init()
    {
        parent::init();

        $this->addClass('mkt_basket_cart_confirm_form');

        $this->addButton('save', BasketModels::carts()->getLabel('form.confirm.submit'));
    }


    public function getDataFromModel()
    {
        parent::getDataFromModel();

        $this->initShowPaymentMethods();
        $this->currency = $this->getModel()->getCurrency();

        if (false == $this->showPaymentMethods()) {
            return;
        }

        $this->initializePaymentMethodsFields();
    }

    /**
     * @return void
     */
    protected function initializePaymentMethodsFields(): void
    {
        $this->paymentMethods = $this->paymentMethods ?: $this->getModel()->getPaymentMethods();
        if (count($this->paymentMethods)) {
            $this->addRadioGroup('id_payment_method', PaymentsModels::methods()->getLabel('title'), true);
            $methodsElement = $this->getElement('id_payment_method');
            $methodsElement->getRenderer()->setSeparator('');
            foreach ($this->paymentMethods as $method) {
                if ($method->isVisible() && $method->supportsCurrency($this->currency)) {
                    $methodsElement->addOption($method->id, $method->getName());

                    if ($methodsElement->getValue() == '' || $method->isPrimary()) {
                        $methodsElement->setValue($method->id);
                    }
                }
            }
        }
    }
    protected function initShowPaymentMethods()
    {
        if ($this->getModel()->getTotal() == 0) {
            $this->setShowPaymentMethods(false);
        }
    }

    /**
     * @param boolean $showPaymentMethods
     */
    public function setShowPaymentMethods($showPaymentMethods): void
    {
        $this->showPaymentMethods = $showPaymentMethods;
    }

    /**
     * @return bool
     */
    public function showPaymentMethods(): bool
    {
        return $this->showPaymentMethods;
    }

    /**
     * @return PaymentMethod[]|Collection
     */
    public function getPaymentMethods()
    {
        return $this->paymentMethods;
    }

    /**
     * @param null $paymentMethods
     */
    public function setPaymentMethods($paymentMethods): void
    {
        $this->paymentMethods = $paymentMethods;
    }
}
