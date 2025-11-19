<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Dto;

use ByTIC\DataObjects\Casts\Metadata\Metadata;
use Money\Currency;

/**
 *
 */
class BasketMetadata extends Metadata
{
    public const KEY_CURRENCY = 'currency';

    public const KEY_CURRENCIES = 'currencies';

    public function getCurrency($default = null): Currency
    {
        $currencyCode = $this->getCurrencyCode($default);
        return new \Money\Currency($currencyCode);
    }

    public function getCurrencyCode($default = null): string
    {
        $default = $this->protectCurrencyCode($default);
        return $this->get(self::KEY_CURRENCY, $default);
    }

    public function setCurrency(string|Currency $currency): self
    {
        $currencyCode = $this->protectCurrencyCode($currency);
        $this->set(self::KEY_CURRENCY, $currencyCode);
        return $this;
    }

    public function getCurrencies($default = null): ?array
    {
        return $this->get(self::KEY_CURRENCIES, $default);
    }

    public function setCurrencies(array|null $currencies): self
    {
        $codes = [];
        foreach ($currencies as $currency) {
            $codes[] = $this->protectCurrencyCode($currency);
        }
        $this->set(self::KEY_CURRENCIES, $codes);
        return $this;
    }

    protected function protectCurrencyCode(string|Currency|null $currency): ?string
    {
        return $currency instanceof Currency ? $currency->getCode() : $currency;
    }
}

