<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Bytic\Actions\Behaviours\Entities\HasResultRecordTrait;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\BasketItems\Models\BasketItem;
use Marktic\Basket\Carts\Models\Cart;
use Marktic\Basket\Order\Models\Order;
use Marktic\Basket\PurchasableItems\Models\PurchasableItemInterface;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 * @method PurchasableItemInterface getSubject()
 * @property BasketItem $resultRecord
 */
abstract class CreateBasketItem extends Action
{
    use HasSubject;
    use HasResultRecordTrait;
    use HasRepository;

    /**
     * @var Cart|Order
     */
    protected $basket;

    public static function for(PurchasableItemInterface $subject, $basket): self
    {
        $action = new static();
        $action->setSubject($subject);
        $action->basket = $basket;
        return $action;
    }

    public function create()
    {
        return $this->getResultRecord();
    }

    protected function populateResultRecord()
    {
        $this->resultRecord->populateFromProduct($this->getSubject());
        $this->resultRecord->populateFromCatalog($this->getSubject()->getBasketCatalog());
        $this->resultRecord->populateFromBasket($this->basket);
    }

    protected function generateRepository(): RecordManager
    {
        return BasketModels::orderItems();
    }
}