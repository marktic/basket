<?php

declare(strict_types=1);

namespace Marktic\Basket\Base\Dto;

use Money\Currency;

class CurrencySettings
{
    /**
     * @var Currency|null
     */
    protected ?Currency $defaultCurrency = null;

    protected ?string $defaultCurrencyCode = null;

    /**
     * @var Currency[]
     */
    protected array $availableCurrencies = [];

    protected array $availableCurrencyCodes = [];

    public function __construct(string $defaultCurrency = null, array $availableCurrencies = [])
    {
        $this->addAvailableCurrencies($availableCurrencies);
        $this->setDefaultCurrency($defaultCurrency);
    }

    public function getDefaultCurrency(): ?Currency
    {
        return $this->defaultCurrency;
    }

    public function getDefaultCurrencyCode(): ?string
    {
        return $this->defaultCurrencyCode;
    }

    /**
     * @return Currency[]
     */
    public function getAvailableCurrencies(): array
    {
        return $this->availableCurrencies;
    }

    public function getAvailableCurrencyCodes(): array
    {
        return $this->availableCurrencyCodes;
    }

    public function setDefaultCurrency($currency): self
    {
        $currency = $this->guardCurrency($currency);
        $this->defaultCurrency = $currency;
        $this->defaultCurrencyCode = $currency?->getCode();
        return $this;
    }

    public function addAvailableCurrency(string|object $currency): self
    {
        $currency = $this->guardCurrency($currency);
        return $this->addAvailableCurrencyObject($currency);
    }

    public function addAvailableCurrencies(?array $codes): static
    {
        if (empty($codes)) {
            return $this;
        }
        foreach ($codes as $code) {
            $this->addAvailableCurrency($code);
        }
        return $this;
    }

    protected function guardCurrency($currency): ?Currency
    {
        if ($currency === null) {
            return null;
        }
        if (is_string($currency)) {
            return new Currency($currency);
        }
        if ($currency instanceof Currency) {
            return $currency;
        }
        if (is_object($currency) && method_exists($currency, 'getCode')) {
            $currencyCode = $currency->getCode();
            return new Currency($currencyCode);
        }
        $currencyCode = (string)$currency;
        return new Currency($currencyCode);
    }

    protected function addAvailableCurrencyObject(Currency $currency): self
    {
        $currencyCode = $currency->getCode();
        $this->availableCurrencies[$currencyCode] = $currency;
        $this->availableCurrencyCodes[$currencyCode] = $currencyCode;
        return $this;
    }
}
