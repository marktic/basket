<?php

namespace Marktic\Basket\Tests\Utility;

use Marktic\Basket\Cart\Models\Carts;
use Marktic\Basket\Tests\AbstractTest;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\Locator\ModelLocator;

/**
 * Class PricingModelsTest
 * @package ByTIC\NotifierBuilder
 */
class PricingModelsTest extends AbstractTest
{
    /**
     * @test
     */
    public function models_adjustments_load_from_config()
    {
        $this->loadConfigFromFixture('mkt_basket');

        ModelLocator::set(Carts::class, new Carts());

        $repository = BasketModels::carts();
        self::assertInstanceOf(Carts::class, $repository);
        self::assertSame('mkt_basket_carts', $repository->getTable());
    }
}
