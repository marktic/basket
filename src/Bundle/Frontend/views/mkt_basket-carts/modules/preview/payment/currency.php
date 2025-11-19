<?php

use Marktic\Basket\Carts\Models\Cart;
use Marktic\Basket\Utility\BasketModels;
use Money\Currency;

/** @var Cart $cart */
$cart = $this->cart;
$currency = $cart->getCurrency();

/** @var Currency[] $currencies */
$currencies = $this->cart_currencies;
if (count($currencies) > 1) {
    ?>
    <strong>
        <?= BasketModels::carts()->getLabel('form.currency'); ?>:
    </strong>

    <div class="btn-group btn-group-sm" role="group">
        <?php foreach ($currencies as $c) { ?>
            <?php if ($c->getCode() == $currency->getCode()) { ?>
                <a href="javascript:" class="btn btn-primary">
                    <strong>
                        <?= $currency->getCode(); ?>
                    </strong>
                </a>
            <?php } else { ?>
                <a href="<?= $cart->compileURL('ChangeCurrency', ['code' => $c->getCode()]) ?>"
                   class="btn btn-light">
                    <?= $c->getCode(); ?>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
    <hr/>
    <?php
}