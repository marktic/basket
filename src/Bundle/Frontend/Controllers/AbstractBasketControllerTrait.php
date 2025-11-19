<?php

declare(strict_types=1);

namespace Marktic\Basket\Bundle\Frontend\Controllers;

use Nip\View\View;

trait AbstractBasketControllerTrait
{
    use \Nip\Controllers\Traits\AbstractControllerTrait;

    public function getModelForm($model, $action = null)
    {
        $class = $this->getModelFormClass($model, $action);
        $form = new $class();
        $form->setModel($model);
        return $form;
    }

    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        $path = __DIR__ . '/../../Resources/views/admin';
        $view->addPath($path);
        $view->addPath($path, 'MarkticPricing');
    }

    abstract protected function getBasketCatalog();
}

