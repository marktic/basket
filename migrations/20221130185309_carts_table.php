<?php

declare(strict_types=1);

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class CartsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table_name = PackageConfig::tableName(BasketModels::CARTS);
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('id_user', 'integer', ['null' => false])
            ->addColumn('id_session', 'string')
            ->addColumn('ip_address', 'string', ['limit' => 46])
            ->addColumn('hash', 'string', ['null' => false])
            ->addColumn('properties', 'text')
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->save();

        $table
            ->addIndex(['hash'], ['unique' => true])
            ->addIndex(['id_user'])
            ->addIndex(['id_session'])
            ->addIndex(['ip_address'])
            ->addIndex(['created_at'])
            ->save();
    }
}
