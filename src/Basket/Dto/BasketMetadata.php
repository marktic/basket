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

    public function getCurrency($default = null): string
    {
        return $this->get(self::KEY_SPORTS, $default);
    }

    public function setCurrency(string $currency): self
    {
        $this->set(self::KEY_SPORTS, $currency);
        return $this;
    }
}

