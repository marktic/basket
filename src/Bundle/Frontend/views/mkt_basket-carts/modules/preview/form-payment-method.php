<?php

use Marktic\Basket\Utility\BasketModels;

$renderer = $this->form->getRenderer();
?>
<?php if (false === $this->form->showPaymentMethods()) { ?>
    <?php return; ?>
<?php } ?>

<div id="cart-payment">
    <div class="section">
        <h4 class="section-title mt-0 fw-bold">
            <?= BasketModels::carts()->getLabel('title.payment') ?>
        </h4>
        <div class="section-content">
            <?= $this->load('./payment/currency'); ?>
            <?= $this->load('./payment/methods'); ?>
        </div>
    </div>
</div>