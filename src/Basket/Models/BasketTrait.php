<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
use Marktic\Basket\Base\Models\HasMetadata\RecordHasMetadataTrait;
use Marktic\Basket\Base\Models\Timestampable\TimestampableTrait;
use Marktic\Basket\Basket\Dto\BasketMetadata;
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

    /**
     * @param $currency
     */
    public function setCurrency($currency)
    {
        $this->getMetadata()->setCurrency($currency);
    }

    protected function getCurrencyDefault()
    {
        return null;
    }
}
