<?php

declare(strict_types=1);

namespace Marktic\Basket\Base\Models\Traits;

use Marktic\Basket\Utility\PackageConfig;
use Nip\Database\Connections\Connection;

/**
 * Trait HasDatabaseConnectionTrait.
 */
trait HasDatabaseConnectionTrait
{
    /**
     * @return Connection
     */
    protected function newDbConnection()
    {
        return \app('db')->connection(PackageConfig::databaseConnection());
    }
}
