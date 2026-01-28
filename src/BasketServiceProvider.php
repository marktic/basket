<?php

declare(strict_types=1);

namespace Marktic\Basket;

use ByTIC\PackageBase\BaseBootableServiceProvider;
use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;

/**
 * Class BasketServiceProvider.
 */
class BasketServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'mkt_basket';

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return \dirname(__DIR__) . '/migrations/';
        }

        return null;
    }

    protected function translationsPath(): string
    {
        return __DIR__ . '/resources/lang/';
    }

    protected function registerCommands()
    {
//        $this->commands(
//        );
    }
    public function boot(): void
    {
        parent::boot();
        BasketModels::carts();
        BasketModels::cartItems();
        BasketModels::orders();
        BasketModels::orderItems();
    }
}
