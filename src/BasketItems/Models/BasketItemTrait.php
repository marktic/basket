<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

use Marktic\Basket\Basket\Models\Basket;
use Marktic\Basket\BasketItems\Actions\BasketItemCalculator;
use Marktic\Basket\PurchasableItems\Models\PurchasableItemInterface;
use Marktic\Pricing\PriceAmounts\ModelsRelated\SaleableHasAmountsRecordTrait;
use Money\Currency;
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
        return (int)$this->getPropertyRaw('quantity');
    }

    public function getTotal(string|Currency|null $currency = null): int
    {
        return BasketItemCalculator::forCurrency($this, $currency)->getTotal();
    }

    public function getTotalMoney(string|Currency|null $currency = null): ?\ByTIC\Money\Money
    {
        return BasketItemCalculator::forCurrency($this, $currency)->getTotalMoney();
    }

    /**
     * @param Record $product
     * @return static
     */
    public function populateFromProduct(Record $product): static
    {
        $this->product_id = $product->id;
        $this->product_type = $product->getManager()->getMorphName();
        return $this;
    }

    /**
     * @param Record $catalog
     * @return static
     */
    public function populateFromCatalog(Record $catalog): static
    {
        $this->catalog_id = $catalog->id;
        $this->catalog_type = $catalog->getManager()->getMorphName();
        return $this;
    }

    /**
     * @param Record $basket
     * @return static
     */
    abstract public function populateFromBasket(Record $basket): static;
}
