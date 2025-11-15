<?php

declare(strict_types=1);

namespace Marktic\Basket\BasketItems\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Basket\PurchasableCatalog\Models\PurchasableCatalogInterface;

abstract class FindBasketItems extends Action
{
    use FindRecords;
    use HasSubject;

    protected PurchasableCatalogInterface $catalog;

    /**
     * @param $subject
     * @return static
     */
    public static function for($subject): self
    {
        $action = new static();
        $action->setSubject($subject);
        return $action;
    }

    public function withCatalog($catalog): static
    {
        $this->catalog = $catalog;
        return $this;
    }

    protected function findParams(): array
    {
        $basketFk = $this->getBasketFk();
        $params = [
            'where' => [
                [$basketFk . ' = ? ', $this->getSubject()->id],
            ]
        ];
        if ($this->catalog) {
            $params['where'][] = ['catalog_id = ? ', $this->catalog->id];
            $params['where'][] = ['catalog_type = ? ', $this->catalog->getManager()->getMorphName()];
        }
        return $params;
    }

    protected function getBasketFk(): string
    {
        return $this->getSubject()->getManager()->getPrimaryFK();
    }
}
