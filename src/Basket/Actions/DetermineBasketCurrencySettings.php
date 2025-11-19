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

    public function execute()
    {
        $basket = $this->getSubject();
        $basketItems = $basket->getItems();
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
