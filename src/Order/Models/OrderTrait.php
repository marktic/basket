<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Models;

use Paytic\Payments\Models\AbstractModels\HasPaymentMethod\HasPaymentMethodRecord;

/**
 * @property int $id_payment_method
 */
trait OrderTrait
{
    use HasPaymentMethodRecord;
}
