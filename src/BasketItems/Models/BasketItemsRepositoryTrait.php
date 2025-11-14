<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

use Marktic\Basket\Basket\Models\Basket;

/**
 * @method Basket getBasket()
 */
trait BasketItemsRepositoryTrait
{
    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsBasket();
    }

    protected function initRelationsBasket(): void
    {
        $this->initRelationsBasketParent();
    }

    protected function initRelationsBasketParent(): void
    {
        $this->belongsTo('Basket',
            ['class' => $this->relationBasketParentClass()]
        );
    }

    abstract protected function relationBasketParentClass();
}
