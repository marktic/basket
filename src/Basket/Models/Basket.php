<?php

declare(strict_types=1);

namespace Marktic\Basket\Basket\Models;

use ByTIC\DataObjects\Casts\AsArrayObject;
use Nip\Records\Record;

abstract class Basket extends Record
{
    use BasketTrait;

    public function __construct(array $data = null)
    {
        parent::__construct($data);

        $this->addCast('properties', AsArrayObject::class . ':serialize');
    }
}
