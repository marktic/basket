<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use Marktic\Basket\Base\Models\HasMetadata\RecordHasMetadataTrait;
use Marktic\Basket\Base\Models\Timestampable\TimestampableTrait;

trait BasketTrait
{
    use TimestampableTrait;
    use RecordHasMetadataTrait;

    protected function getMetadataClass(): ?string
    {
        return BasketMetadata::class;
    }
}
