<?php

namespace Marktic\Basket\Base\Models\Traits;

use Marktic\Basket\Utility\PackageConfig;
use Nip\Database\Connections\Connection;

use function app;

/**
 * Trait HasDatabaseConnectionTrait
 * @package Marktic\Basket\Models\AbstractModels
 */
trait HasDatabaseConnectionTrait
{

    /**
     * @return Connection
     */
    protected function newDbConnection()
    {
        return app('db')->connection(PackageConfig::databaseConnection());
    }
}

