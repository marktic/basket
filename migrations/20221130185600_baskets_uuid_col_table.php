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
            $table = $this->table($table);
            $table->renameColumn('hash', 'uuid');
            $table->save();
            $table->changeColumn('uuid', 'uuid', ['default' => 'uuid_generate_v4()']);
            $table->save();
        }
    }
}
