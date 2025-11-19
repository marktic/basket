<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\Base\Dto\CurrencySettings;
use Marktic\Basket\Basket\Models\Basket;
use Marktic\Basket\BasketItems\Models\BasketItem;

/**
 * @method BasketItem getSubject()
 */
class DetermineBasketItemCurrencySettings extends Action
{
    use HasSubject;

    protected static $cache = [];

    public function execute(): CurrencySettings
    {
        $cacheKey = $this->determineCacheKey();
        if (!isset(static::$cache[$cacheKey])) {
            static::$cache[$cacheKey] = $this->buildSettings();
        }
        return static::$cache[$cacheKey];
    }

    protected function determineCacheKey(): string
    {
        return spl_object_hash($this->getSubject());
    }

    protected function buildSettings(): CurrencySettings
    {
        $basket = $this->getSubject();
        $basketProduct = $basket->getBasketProduct();
        $priceAmounts = $basketProduct->getPriceAmountsMultiCurrency();

        $settings = new CurrencySettings();
        $settings->setDefaultCurrency($priceAmounts->getDefaultCurrency());
        $settings->addAvailableCurrencies($priceAmounts->getCurrencies());
        return $settings;
    }
}
