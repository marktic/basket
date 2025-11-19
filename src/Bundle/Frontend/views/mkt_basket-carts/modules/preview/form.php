<?php $renderer = $this->form->getRenderer(); ?>
<?= $renderer->openTag(); ?>
<?= $renderer->renderHidden(); ?>
<?= $renderer->renderMessages(); ?>
<?= $this->Flash()->render($this->controller); ?>

<div class="d-grid gap-5">
    <?= $this->load('/mkt_basket-carts/modules/preview/form-payment-method'); ?>
    <?php //$this->load('/mkt_basket-carts/modules/preview/billing'); ?>

    <?= $this->load('/mkt_basket-carts/modules/preview/form-confirm-container'); ?>

</div>
<?= $renderer->closeTag(); ?>