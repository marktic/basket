<?php
use Marktic\Basket\Utility\BasketModels;

$cartsRepository = BasketModels::carts();
$confirmBtnLabel = $this->form->showPaymentMethods() ? 'confirm.btn' : 'confirm.btn.no-payment';
$confirmBtnLabelText = $cartsRepository->getLabel($confirmBtnLabel);
?>
<div id="cart-confirm" class="bg-info bg-opacity-25 p-3 text-center">
    <h3 class="title fw-bold">
        <?= $cartsRepository->getLabel('confirm.title'); ?>
    </h3>
    <p><?= $cartsRepository->getLabel('confirm.description'); ?></p>


    <button class="btn btn-primary btn-lg" type="submit" name="save" title="<?= $confirmBtnLabelText; ?>">
        <i class="fas fa-shopping-cart"></i>
        <?= $confirmBtnLabelText; ?>
    </button>
</div>  