<?php

declare(strict_types=1);

namespace Marktic\Basket\PurchasableCatalog\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Paytic\Payments\MethodLinks\Actions\FindPaymentMethodLinksForTenant;

class DetermineCartPaymentMethods extends Action
{
    use HasSubject;

    protected $tenant;


    public function forTenant($tenant): self
    {
        $this->tenant = $tenant;
        return $this;
    }

    public function find()
    {
        if (!$this->tenant) {
            throw new \Exception('Tenant not set');
        }
        $paymentMethods = FindPaymentMethodLinksForTenant::for($this->tenant)->fetch();

        return $paymentMethods;
    }
}
