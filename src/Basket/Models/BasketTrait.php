<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
use Marktic\Basket\Base\Models\HasMetadata\RecordHasMetadataTrait;
use Marktic\Basket\Base\Models\Timestampable\TimestampableTrait;
use Marktic\Basket\Basket\Dto\BasketMetadata;
use Marktic\Basket\BasketItems\Actions\DetermineBasketItemCurrencySettings;
use Money\Currency;

trait BasketTrait
{
    use TimestampableTrait;
    use HasFormsRecordTrait;
    use RecordHasMetadataTrait;

    protected function getMetadataClass(): ?string
    {
        return BasketMetadata::class;
    }

    public function getTotal($currency = null)
    {
        return 10;
    }

    /**
     * @return Currency
     */
    public function getCurrency($default = null): Currency
    {
        return $this->getMetadata()->getCurrency($default ?? $this->getCurrencyDefault());
    }

    public function getAndSetCurrency($default = null): Currency
    {
        $currency = $this->getMetadata()->getCurrency($default ?? $this->getCurrencyDefault());
        $this->setCurrency($currency);
        $this->save();
        return $currency;
    }

    /**
     * @param $currency
     */
    public function setCurrency($currency)
    {
        $this->getMetadata()->setCurrency($currency);
        return $this;
    }

    public function getAndSetAvailableCurrencies($default = null): array|null
    {
        $currencies = $this->getMetadata()->getCurrencies($default ?? $this->getCurrencyDefault());
        $this->setCurrencies($currencies);
        $this->save();
        return $currency;
    }

    public function setCurrencies($currencies)
    {
        $this->getMetadata()->setCurrencies($currencies);
        return $this;
    }

    protected function getCurrencyDefault()
    {
        $settings = DetermineBasketItemCurrencySettings::for($this)->execute();
        return $settings->getDefaultCurrencyCode();
    }

    protected function getAvailableCurrenciesDefault()
    {
        $settings = DetermineBasketItemCurrencySettings::for($this)->execute();
        return $settings->getAvailableCurrencyCodes();
    }
}
