<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\VatTuThanhToan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vat-tu-thanh-toan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'ten_vat_tu')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'so_luong')->textInput(['id' => 'so-luong']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'don_gia')->textInput(['id' => 'don-gia']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'thanh_tien')->textInput(['id' => 'thanh-tien', 'readonly' => true]) ?>
        </div>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
$script = <<< JS
function tinhThanhTien() {
    let soLuong = parseFloat($('#so-luong').val().replace(/,/g, '')) || 0;
    let donGia = parseFloat($('#don-gia').val().replace(/,/g, '')) || 0;
    let thanhTien = soLuong * donGia;
    $('#thanh-tien').val(thanhTien);
}

$('#so-luong, #don-gia').on('keyup change', function() {
    tinhThanhTien();
});
JS;

$this->registerJs($script);
?>

