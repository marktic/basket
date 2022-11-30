<?php

namespace Marktic\Basket\Utility;

use Exception;
use Marktic\Basket\BasketServiceProvider;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = BasketServiceProvider::NAME;

    public const DEFAULT_CURRENCY = 'EUR';

    public static function configPath(): string
    {
        return __DIR__ . '/../../config/mkt_basket.php';
    }

    public static function tableName($name, $default = null)
    {
        return static::instance()->get('tables.' . $name, $default);
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function databaseConnection(): ?string
    {
        return (string)static::instance()->get('database.connection');
    }

    public static function shouldRunMigrations(): bool
    {
        return static::instance()->get('database.migrations', false) !== false;
    }
}