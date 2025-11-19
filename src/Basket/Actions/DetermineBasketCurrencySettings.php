<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\Base\Dto\CurrencySettings;
use Marktic\Basket\Basket\Models\Basket;
use Marktic\Basket\BasketItems\Actions\DetermineBasketItemCurrencySettings;

/**
 * @method Basket getSubject()
 */
class DetermineBasketCurrencySettings extends Action
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
        $basketItems = $basket->getBasketItems();
        $basketItems->loadRelations(['BasketProduct']);

        $settings = new CurrencySettings();
        foreach ($basketItems as $item) {
            $itemSettings = DetermineBasketItemCurrencySettings::for($item)->execute();
            $settings->addAvailableCurrencies($itemSettings->getAvailableCurrencies());
            $settings->setDefaultCurrency($itemSettings->getDefaultCurrency());
        }

        return $settings;
    }
}
