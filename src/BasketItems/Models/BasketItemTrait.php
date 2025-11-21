<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

use Marktic\Basket\Basket\Models\Basket;
use Marktic\Basket\PurchasableItems\Models\PurchasableItemInterface;
use Marktic\Pricing\PriceAmounts\ModelsRelated\SaleableHasAmountsRecordTrait;
use Nip\Records\AbstractModels\Record;

/**
 * @property int $catalog_id
 * @property string $catalog_type
 * @property int $product_id
 * @property string $product_type
 *
 * @method PurchasableItemInterface|SaleableHasAmountsRecordTrait getBasketProduct()
 * @method Basket getBasket()
 */
trait BasketItemTrait
{

    public function getQuantity(): int
    {
        return $this->getPropertyRaw('quantity');
    }

    /**
     * @param Record $product
     * @return $this
     */
    public function populateFromProduct($product): static
    {
        $this->product_id = $product->id;
        $this->product_type = $product->getManager()->getMorphName();
        return $this;
    }

    /**
     * @param Record $product
     * @return $this
     */
    public function populateFromCatalog($catalog)
    {
        $this->catalog_id = $catalog->id;
        $this->catalog_type = $catalog->getManager()->getMorphName();
        return $this;
    }

    /**
     * @param Record $product
     * @return $this
     */
    abstract public function populateFromBasket($basket);
}
