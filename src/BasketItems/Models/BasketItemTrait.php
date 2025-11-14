<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Models;

/**
 * @property int $catalog_id
 * @property string $catalog_type
 * @property int $product_id
 * @property string $product_type
 */
trait BasketItemTrait
{
    public function populateFromProduct($product)
    {
        $this->product_id = $product->id;
        $this->product_type = $product->getModelManager()->getMorphName();
        return $this;
    }

    public function populateFromCatalog($catalog)
    {
        $this->catalog_id = $catalog->id;
        $this->catalog_type = $catalog->getModelManager()->getMorphName();
        return $this;
    }

    abstract public function populateFromBasket($basket);
}
