<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Models;

use Paytic\Payments\PaymentMethods\ModelsRelated\HasPaymentMethod\HasPaymentMethodRecordTrait;

/**
 * @property int $id_payment_method
 */
trait OrderTrait
{
    use HasPaymentMethodRecordTrait;

    /**
     * @return string
     */
    public function compileThankYouOrderUrl()
    {
        return $this->compileURL('ThankYou');
    }
}
