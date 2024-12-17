<?php

declare(strict_types=1);

namespace Marktic\Basket\Order\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Bytic\Actions\Behaviours\Entities\HasResultRecordTrait;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\AbstractModels\RecordManager;

class CreateOrderAction extends Action
{
    use HasResultRecordTrait;
    use HasRepository;

    public function create()
    {
        return $this->getResultRecord();
    }

    public function addItem($item): static
    {
        AddOrderItemToOrder::for($this->getResultRecord())->addItem($item);
        return $this;
    }

    protected function populateResultRecord()
    {

    }

    protected function generateRepository(): RecordManager
    {
        return BasketModels::orders();
    }
}