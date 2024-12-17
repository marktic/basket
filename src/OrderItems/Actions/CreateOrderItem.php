<?php

declare(strict_types=1);

namespace Marktic\Basket\OrderItems\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Bytic\Actions\Behaviours\Entities\HasResultRecordTrait;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\BasketItems\Models\BasketItem;
use Marktic\Basket\PurchasableItems\Models\PurchasableItemInterface;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 * @method PurchasableItemInterface getSubject()
 * @property BasketItem $resultRecord
 */
class CreateOrderItem extends Action
{
    use HasSubject;
    use HasResultRecordTrait;
    use HasRepository;

    public static function for(PurchasableItemInterface $subject): self
    {
        $action = new static();
        $action->setSubject($subject);
        return $action;
    }

    public function create()
    {
        return $this->getResultRecord();
    }

    protected function populateResultRecord()
    {
        $this->resultRecord->populateFromProduct($this->getSubject());
        if (method_exists($this->getSubject(), 'getBasketCatalog')) {
            $this->resultRecord->populateFromCatalog($this->getSubject()->getBasketCatalog());
        }
    }

    protected function generateRepository(): RecordManager
    {
        return BasketModels::orderItems();
    }
}