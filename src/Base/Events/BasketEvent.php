<?php

declare(strict_types=1);

namespace Marktic\Basket\Base\Events;

use ByTIC\EventDispatcher\Events\Dispatchable;
use ByTIC\EventDispatcher\Events\EventInterface;
use ByTIC\EventDispatcher\Events\EventTrait;
use Psr\EventDispatcher\StoppableEventInterface;

class BasketEvent implements EventInterface, StoppableEventInterface
{
    use EventTrait;
    use Dispatchable;
}

