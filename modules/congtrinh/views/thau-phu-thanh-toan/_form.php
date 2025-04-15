<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\NhanCongThanhToan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thau-phu-thanh-toan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
              <?= $form->field($model, 'ten_cong_viec')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'tong_hop_dong')->textInput() ?>
        </div>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
