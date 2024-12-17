<?php

declare(strict_types=1);

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class CartItemsTable extends AbstractMigration
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
        $table_name = PackageConfig::tableName(BasketModels::CART_ITEMS);
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('cart_id', 'integer', ['null' => false])
            ->addColumn('catalog_id', 'integer', ['null' => true])
            ->addColumn('catalog_type', 'string', ['null' => true])
            ->addColumn('product_id', 'integer', ['null' => true])
            ->addColumn('product_type', 'string', ['null' => true])
            ->addColumn('quantity', 'integer', ['null' => false])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->save();

        $table
            ->addIndex(['cart_id'])
            ->addIndex(['catalog_id'])
            ->addIndex(['catalog_type'])
            ->addIndex(['product_id'])
            ->addIndex(['product_type'])
            ->save();

        $cartTable = PackageConfig::tableName(BasketModels::CARTS);
        $table
            ->addForeignKey(
                'cart_id',
                $cartTable,
                'id',
                [
                    'constraint' => 'mkt_baskets_items_cart_id',
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->save();
    }
}
