<?php

namespace Marktic\Basket\Basket\Models;

use Nip\Records\RecordManager;

abstract class Baskets extends RecordManager
{
    use BasketRepositoryTrait;
}