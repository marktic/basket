<?php

use Paytic\Payments\Models\Methods\Types\CreditCards;

$renderer = $this->form->getRenderer();
/** @var Nip_Form_Element_RadioGroup $methodsRadio */
$methodsRadio = $this->form->getElement('id_payment_method');

/** @var Nip_Form_Renderer_Elements_RadioGroup $renderer */
$renderer = $methodsRadio->getRenderer();

/** @var Payment_Method[] $paymentMethods */
$paymentMethods = $this->form->getPaymentMethods();
/** @var Nip_Form_Element_Radio[] $methodsRadioChildrens */
$methodsRadioChildrens = $methodsRadio->getElements();
?>

<div id="payment_methods">
<?php foreach ($methodsRadioChildrens as $methodsRadioChild) { ?>
    <?php $paymentMethod = $paymentMethods[$methodsRadioChild->getValue()]; ?>
    <?php $methodType = $paymentMethod->getType(); ?>
    <div class="row mb-3">
        <div class="col-sm-9">
            <div class="radio">
                <label>
                    <input type="radio" name="id_payment_method" value="<?php echo $paymentMethod->id ?>"
                        <?php echo $methodsRadio->getValue() == $methodsRadioChild->getValue() ? 'checked' : ''; ?> >
                    <strong class="method-name">
                        <?php echo $paymentMethod->getName(); ?>
                    </strong>
                    <?php if ($methodType instanceof CreditCards) { ?>
                        <?php
                        $gateway = $methodType->getGateway();
                        $imageURL = asset('/images/payment-gateways/credit_cards.jpg');
                        ?>
                        <img src="<?php echo $imageURL; ?>" style="height: 20px;margin: 0 10px"/>
                    <?php } ?>
                    <div class="explination help-block">
                        <?php echo $methodType->getMessage(); ?>
                    </div>
                </label>
            </div>
        </div>
    </div>
<?php } ?>
</div>