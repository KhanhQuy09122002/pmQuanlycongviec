<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\custom\CustomFunc;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\CaMayThanhToan */
/* @var $form yii\widgets\ActiveForm */
$model->ngay_thanh_toan = CustomFunc::convertYMDToDMY($model->ngay_thanh_toan);
?>

<div class="ca-may-thanh-toan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-5">
              <?= $form->field($model, 'ten_ca_may')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
              <?= $form->field($model, 'so_tien')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ngay_thanh_toan')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
                 //'value' => $model->ngay_thanh_toan ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
                 'todayHighlight'=>true,
                 'todayBtn'=>true
             ]
            ]); ?>
        </div>
        <div class="col-md-12">
              <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>
        </div>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
