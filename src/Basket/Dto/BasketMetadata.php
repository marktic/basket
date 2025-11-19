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
    public const KEY_SPORTS = 'currency';

    public function getCurrency($default = null): Currency
    {
        $currencyCode = $this->getCurrencyCode($default);
        return new \Money\Currency($currencyCode);
    }

    public function getCurrencyCode($default = null): string
    {
        $default = $this->protectCurrencyCode($default);
        return $this->get(self::KEY_SPORTS, $default);
    }

    public function setCurrency(string|Currency $currency): self
    {
        $currencyCode = $this->protectCurrencyCode($currency);
        $this->set(self::KEY_SPORTS, $currencyCode);
        return $this;
    }

    protected function protectCurrencyCode(string|Currency|null $currency): ?string
    {
        return $currency instanceof Currency ? $currency->getCode() : $currency;
    }
}

