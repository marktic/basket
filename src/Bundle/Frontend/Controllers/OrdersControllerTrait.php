<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Controllers;


use Paytic\Payments\Utility\PaymentsModels;

trait OrdersControllerTrait
{

    public function confirm()
    {
        $item = $this->itemInitView();

        $paymentMethod = $item->getPayment_Method();

        $redirectURL = $item->compileThankYouOrderUrl();
        $redirectTarget = '';
        if (strpos($redirectURL, '42km') === false) {
            $redirectTarget = '_top';
        }
        if (strpos($redirectURL, 'sportic') === false) {
            $redirectTarget = '_top';
        }

        $paymentRepository = PaymentsModels::purchases();
        if ($paymentMethod) {
            if ($paymentMethod->checkConfirmRedirect()) {
                $redirectURL = $paymentRepository->compileURL('GenerateFromOrder', ['order' => $item->getHash()]);
                $redirectTarget = '_top';
            } elseif ($paymentMethod->getType() instanceof BankTransfer) {
                $redirectURL = $paymentRepository->compileURL('OrderInstructions', ['order' => $item->getHash()]);
            }
        }

        $this->getView()->set('redirectUrl', $redirectURL);
        $this->getView()->set('redirectTarget', $redirectTarget);
    }

    abstract protected function getCart();

    abstract protected function getBasketPaymentTenant();

    abstract protected function getBasketCatalog();
}

