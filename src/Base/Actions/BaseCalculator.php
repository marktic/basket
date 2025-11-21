<?php

declare(strict_types=1);

namespace Marktic\Basket\Base\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use ByTIC\Money\Currencies\Actions\InitCurrency;
use ByTIC\Money\Utility\Money;
use Money\Currency;

abstract class BaseCalculator extends Action
{
    use HasSubject;

    protected ?Currency $currency = null;

    public static function forCurrency($subject, string $currency = null): static
    {
        static $cache = [];

        $currency = $subject->getCurrency($currency);
        $key = spl_object_id($subject) . $currency->getCode();
        if (!isset($cache[$key])) {
            $calculator = self::for($subject)->withCurrency($currency);
            $cache[$key] = $calculator;
        }
        return $cache[$key];
    }

    public function getTotal()
    {
        if ($this->getSubject()->amount > 0 && $this->getSubject()->currency_code == $this->currency->getCode()) {
            return $this->getSubject()->amount;
        }
        $amountMeta = $this->getSubject()->getMetadata()->getWithCurrency('amount', $this->currency);
        if ($amountMeta > 0) {
            return $amountMeta;
        }
        return $this->getAttributeWithGenerator('total', function () {
            return $this->calculateTotal();
        });
    }

    public function getTotalMoney(): \ByTIC\Money\Money
    {
        $amount = $this->getTotal();
        return Money::fromCents($amount, $this->currency);
    }

    public function getSubTotal()
    {
        return $this->getAttributeWithGenerator('subtotal', function () {
            return $this->calculateSubTotal();
        });
    }

    public function getSubTotalMoney(): ?\ByTIC\Money\Money
    {
        $amount = $this->getSubTotal();
        return Money::fromCents($amount, $this->currency);
    }

    public function withCurrency($currency): static
    {
        $this->currency = InitCurrency::from($currency);
        return $this;
    }

    protected function calculateTotal(): int
    {
        $total = Money::fromCents(0, $this->currency);
        $total->add($this->getSubTotalMoney());
        return $total->toCents();
    }

    abstract protected function calculateSubTotal(): int;
}

