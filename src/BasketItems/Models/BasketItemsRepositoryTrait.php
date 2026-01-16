<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

use Marktic\Basket\Base\Models\Timestampable\TimestampableManagerTrait;
use Marktic\Basket\Basket\Models\Basket;

/**
 * @method Basket getBasket()
 */
trait BasketItemsRepositoryTrait
{
    use TimestampableManagerTrait;

    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsBasket();
    }

    protected function initRelationsBasket(): void
    {
        $this->initRelationsBasketParent();
        $this->initRelationsBasketProduct();
    }
    protected function initRelationsBasketProduct(): void
    {
        $this->morphTo(
            'BasketProduct',
            ['morphPrefix' => 'product']
        );
    }

    protected function initRelationsBasketParent(): void
    {
        $this->belongsTo('Basket',
            [
                'class' => $this->relationBasketParentClass()
            ]
        );
    }

    abstract protected function relationBasketParentClass();
}
