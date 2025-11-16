<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Dto;

use ByTIC\DataObjects\Casts\Metadata\Metadata;

/**
 *
 */
class BasketMetadata extends Metadata
{
    public const KEY_SPORTS = 'currency';

    public function getCurrency(): string
    {
        return $this->get(self::KEY_SPORTS);
    }

    public function setCurrency(string $currency): self
    {
        $this->set(self::KEY_SPORTS, $currency);
        return $this;
    }
}

