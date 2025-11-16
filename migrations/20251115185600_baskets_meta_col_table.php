<?php

declare(strict_types=1);

use Marktic\Basket\Utility\BasketModels;
use Marktic\Basket\Utility\PackageConfig;
use Phinx\Migration\AbstractMigration;

final class BasketsUuidColTable extends AbstractMigration
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
        $cartTable = PackageConfig::tableName(BasketModels::CARTS);
        $orderTable = PackageConfig::tableName(BasketModels::ORDERS);

        foreach ([$cartTable, $orderTable] as $table) {
            $table = $this->table($cartTable);
            $table->changeColumn('properties', 'json', ['null' => true]);
            $table->renameColumn('properties', 'metadata');
            $table->save();
        }
    }
}
