<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Controllers;

trait AbstractBasketControllerTrait
{
    abstract protected function getBasketCatalog();
}

