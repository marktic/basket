<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

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
