<?php

declare(strict_types=1);

namespace Marktic\Basket\Base\Models\HasMetadata;

use ByTIC\DataObjects\Casts\Metadata\AsMetadataObject;
use ByTIC\DataObjects\Casts\Metadata\Metadata;

/**
 *
 */
trait RecordHasMetadataTrait
{

    public function bootRecordHasMetadataTrait(): void
    {
        $class = $this->getMetadataClass();

        $this->addCast(
            'metadata',
            AsMetadataObject::class.':json'
            .($class ? ','.$class : null)
        );
    }

    protected function getMetadataClass(): ?string
    {
        return null;
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function getMetadataValue($key, $default = null): mixed
    {
        return $this->metadata->get($key, $default);
    }

    public function getMetadata(): Metadata
    {
        return $this->getPropertyValue('metadata');
    }

    /**
     * @param $key
     * @param $value
     */
    public function setMetadataValue($key, $value): void
    {
        $this->metadata->set($key, $value);
    }
}
