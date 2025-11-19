<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\FindRecord;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\Basket\Models\Basket;
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
    use FindRecord;
    use HasSubject;

    /**
     * @var Cart|Order
     */
    protected $basket;

    protected $quantity = 1;

    protected $metadata = [];

    public static function for(PurchasableItemInterface $subject, $basket): static
    {
        $action = new static();
        $action->setSubject($subject);
        $action->basket = $basket;
        $action->orCreate();
        return $action;
    }

    public function withQuantity($quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function withMetadata($metadata): static
    {
        $this->metadata = $metadata;
        return $this;
    }

    public function create(): ?\Nip\Records\AbstractModels\Record
    {
        $item = $this->fetch();
        $item->quantity = $item->quantity + $this->quantity;
        $item->metadata = $this->metadata;
        $item->save();
        return $item;
    }

    protected function orCreateData($data)
    {
        $basketFk = $this->getBasketFk();
        $subject = $this->getSubject();
        $basketCatalog = $subject->getBasketCatalog();

        $data[$basketFk] = $this->basket->id;
        $data['catalog_id'] = $basketCatalog->id;
        $data['catalog_type'] = $basketCatalog->getManager()->getMorphName();
        $data['product_id'] = $subject->id;
        $data['product_type'] = $subject->getManager()->getMorphName();
        $data['quantity'] = 0;
        return $data;
    }

    protected function populateResultRecord(): void
    {
        $this->resultRecord->populateFromProduct($this->getSubject());
        $this->resultRecord->populateFromCatalog($this->getSubject()->getBasketCatalog());
        $this->resultRecord->populateFromBasket($this->basket);
    }

    protected function findParams(): array
    {
        $basketFk = $this->getBasketFk();
        $subject = $this->getSubject();
        $basketCatalog = $subject->getBasketCatalog();
        return [
            'where' => [
                [$basketFk . ' = ? ', $this->basket->id],
                ['catalog_id = ? ', $basketCatalog->id],
                ['catalog_type = ? ', $basketCatalog->getManager()->getMorphName()],
                ['product_id = ? ', $subject->id],
                ['product_type = ? ', $subject->getManager()->getMorphName()],
            ]
        ];
    }

    protected function getBasketFk(): string
    {
        return $this->basket->getManager()->getPrimaryFK();
    }

    protected function generateRepository(): RecordManager
    {
        return BasketModels::orderItems();
    }
}