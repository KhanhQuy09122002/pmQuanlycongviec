<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form-print-options">
    <?php $form = ActiveForm::begin([
        'id' => 'form-print',
        'action' => ['print-preview'],
        'method' => 'get',
        'options' => ['target' => '_blank']
    ]); ?>

    <div class="row">
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'id_cong_trinh', [
                'labelOptions' => ['class' => 'fw-bold']
            ])->dropDownList($congTrinhList, ['prompt'=>'-- Chọn công trình --'])->label('Công trình') ?>
        </div>

    
    </div>
    <?php ActiveForm::end(); ?>
</div>


