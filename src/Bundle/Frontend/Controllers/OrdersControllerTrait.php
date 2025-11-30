<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Controllers;


use Marktic\Basket\Order\Models\Order;
use Paytic\Payments\Models\Methods\Types\BankTransfer;
use Paytic\Payments\Utility\PaymentsModels;

trait OrdersControllerTrait
{

    public function confirm()
    {
        $item = $this->itemInitView();

        $paymentMethod = $item->getPaymentMethod();

        $redirectURL = $item->compileThankYouOrderUrl();
        $redirectTarget = '';
        $baseUrl = request()->getBaseUrl();
        if (strpos($redirectURL, $baseUrl) === false) {
            $redirectTarget = '_top';
        }

        $paymentRepository = PaymentsModels::purchases();
        if ($paymentMethod) {
            $urlPk = $item->getManager()->getUrlPK();
            if ($paymentMethod->checkConfirmRedirect()) {
                $redirectURL = $paymentRepository->compileURL('GenerateFromOrder', ['order' => $item->$urlPk]);
                $redirectTarget = '_top';
            } elseif ($paymentMethod->getType() instanceof BankTransfer) {
                $redirectURL = $paymentRepository->compileURL('OrderInstructions', ['order' => $item->$urlPk]);
            }
        }

        $this->payload()->with(
            [
                'redirectUrl' => $redirectURL,
                'redirectTarget' => $redirectTarget,
            ]
        );
    }

    /**
     * @return Order
     */
    protected function itemInitView()
    {
        /** @var Order $item */
        $item = $this->getModelFromRequest(['uuid','uuid']);
        $oItems = $item->getBasketItems();

        $this->payload()->with(
            [
                'order' => $item,
                'item' => $item,
                'order_items' => $oItems,
                'orderCurrency' => $item->getCurrency(),
                'payment_method' => $item->getPaymentMethod(),
            ]
        );

        return $item;
    }

    abstract protected function getCart();

    abstract protected function getBasketPaymentTenant();

    abstract protected function getBasketCatalog();
}

