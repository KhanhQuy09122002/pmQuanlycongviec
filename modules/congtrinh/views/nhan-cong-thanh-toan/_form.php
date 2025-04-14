<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\NhanCongThanhToan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhan-cong-thanh-toan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cong_trinh')->textInput() ?>

    <?= $form->field($model, 'ho_ten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tong_hop_dong')->textInput() ?>

    <?= $form->field($model, 'da_thanh_toan')->textInput() ?>

    <?= $form->field($model, 'con_lai')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'thoi_gian_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
