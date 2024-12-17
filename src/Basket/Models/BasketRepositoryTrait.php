<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use Nip\Records\Traits\HasUuid\HasUuidRecordManagerTrait;

trait BasketRepositoryTrait
{
    use HasUuidRecordManagerTrait;


    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsBasket();
    }

    protected function initRelationsBasket()
    {
        $this->initRelationsBasketItems();
    }

    protected function initRelationsBasketItems()
    {
        $this->hasMany('BasketItems',
            ['class' => $this->relationBasketItemsClass()]
        );
    }

    abstract function relationBasketItemsClass() : string;

    public function uuidColumn(): string
    {
        return 'hash';
    }
}
