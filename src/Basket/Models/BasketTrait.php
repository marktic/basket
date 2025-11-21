<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use ByTIC\Money\Currencies\Actions\InitCurrency;
use ByTIC\Money\Utility\Money;
use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
use Marktic\Basket\Base\Models\HasMetadata\RecordHasMetadataTrait;
use Marktic\Basket\Base\Models\Timestampable\TimestampableTrait;
use Marktic\Basket\Basket\Actions\BasketCalculator;
use Marktic\Basket\Basket\Actions\DetermineBasketCurrencySettings;
use Marktic\Basket\Basket\Dto\BasketMetadata;
use Marktic\Basket\BasketItems\Models\BasketItem;
use Money\Currency;
use Nip\Records\Collections\Collection;
use Nip\Records\Traits\HasUuid\HasUuidRecordTrait;

/**
 * @method BasketItem[]|Collection getBasketItems()
 * @method BasketMetadata getMetadata()
 */
trait BasketTrait
{
    use TimestampableTrait;
    use HasUuidRecordTrait;
    use HasFormsRecordTrait;
    use RecordHasMetadataTrait;

    protected function getMetadataClass(): ?string
    {
        return BasketMetadata::class;
    }

    public function getTotal($currency = null)
    {
        $currency = $this->guardCurrency($currency);
        $metadata = $this->getMetadata();
        $value = $metadata->getWithCurrency('amount', $currency, function () use ($currency) {
            return $this->calculateTotal($currency);
        });
        $metadata->setWithCurrency('amount', $value, $currency);
        return $value;
    }

    public function getTotalMoney($currency = null): ?\ByTIC\Money\Money
    {
        $currency = $this->guardCurrency($currency);
        $amount = $this->getTotal($currency);
        return Money::fromCents($amount, $currency);
    }

    protected function calculateTotal($currency = null)
    {
        return BasketCalculator::forCurrency($this, $currency)->getTotal();
    }

    /**
     * @return Currency
     */
    public function getCurrency($default = null): Currency
    {
        return $this->guardCurrency(null, $default);
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

    protected function guardCurrency($currency, $default = null): Currency
    {
        if ($currency !== null) {
            return InitCurrency::from($currency);
        }
        $currencyCode = $this->currency_code;
        if ($currencyCode !== null) {
            return InitCurrency::from($currencyCode);
        }
        $currencyCode = $this->getMetadata()->getCurrency($default ?? $this->getCurrencyDefault());
        return InitCurrency::from($currencyCode);
    }

    public function getAndSetAvailableCurrencies($default = null): array|null
    {
        $currencies = $this->getMetadata()->getCurrencies($default ?? $this->getCurrencyDefault());
        $this->setCurrencies($currencies);
        $this->save();
        return $currencies;
    }

    public function setCurrencies($currencies)
    {
        $this->getMetadata()->setCurrencies($currencies);
        return $this;
    }

    protected function getCurrencyDefault()
    {
        $settings = DetermineBasketCurrencySettings::for($this)->execute();
        return $settings->getDefaultCurrencyCode();
    }

    protected function getAvailableCurrenciesDefault()
    {
        $settings = DetermineBasketCurrencySettings::for($this)->execute();
        return $settings->getAvailableCurrencyCodes();
    }
}
