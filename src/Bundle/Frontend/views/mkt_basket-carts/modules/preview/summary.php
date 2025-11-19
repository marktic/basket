<?php

use Marktic\Basket\CartItems\Models\CartItem;
use Marktic\Basket\Utility\BasketModels;

/** @var CartItem[] $items */
$items = $this->cItems;
?>
<div class="bg-light-subtle p-3">
    <h3>
        <?= BasketModels::carts()->getLabel('title.summary') ?>
    </h3>

    <table class="table table-hover">
        <tbody>
        <?php foreach ($items as $cartItem): ?>
            <?= $this->load('/mkt_basket-carts_items/modules/item/cart-summary', ['cartItem' => $cartItem]) ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
