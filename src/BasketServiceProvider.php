<?php

declare(strict_types=1);

namespace Marktic\Basket;

use ByTIC\PackageBase\BaseBootableServiceProvider;
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

    protected function registerResources()
    {
        if (false === $this->getContainer()->has('translator')) {
            return;
        }
        $translator = $this->getContainer()->get('translator');
        $folder = __DIR__ . '/Bundle/Resources/lang/';
        $languages = $this->getContainer()->get('translation.languages');

        foreach ($languages as $language) {
            $path = $folder . $language;
            if (is_dir($path)) {
                $translator->addResource('php', $path, $language);
            }
        }
    }

    protected function registerCommands()
    {
//        $this->commands(
//        );
    }

    public function provides(): array
    {
        return array_merge(
            [
            ],
            parent::provides()
        );
    }
}
