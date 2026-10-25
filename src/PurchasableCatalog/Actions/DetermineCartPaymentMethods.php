<?php

declare(strict_types=1);

namespace Marktic\Basket\PurchasableCatalog\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Paytic\Payments\MethodLinks\Actions\FindPaymentMethodLinksForTenant;

class DetermineCartPaymentMethods extends Action
{
    use HasSubject;

    protected mixed $tenant;


    public function forTenant(mixed $tenant): self
    {
        $this->tenant = $tenant;
        return $this;
    }

    /** @return iterable<mixed> */
    public function find(): iterable
    {
        if ($this->tenant === null) {
            throw new \Exception('Tenant not set');
        }
        return FindPaymentMethodLinksForTenant::for($this->tenant)->fetch();
    }
}
