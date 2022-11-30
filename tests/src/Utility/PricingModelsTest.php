<?php

declare(strict_types=1);

namespace Marktic\Basket\Tests\Utility;

use Marktic\Basket\Cart\Models\Carts;
use Marktic\Basket\Tests\AbstractTest;
use Marktic\Basket\Utility\BasketModels;
use Nip\Records\Locator\ModelLocator;

/**
 * Class PricingModelsTest.
 */
class PricingModelsTest extends AbstractTest
{
    public function testModelsAdjustmentsLoadFromConfig()
    {
        $this->loadConfigFromFixture('mkt_basket');

        ModelLocator::set(Carts::class, new Carts());

        $repository = BasketModels::carts();
        self::assertInstanceOf(Carts::class, $repository);
        self::assertSame('mkt_basket_carts', $repository->getTable());
    }
}
