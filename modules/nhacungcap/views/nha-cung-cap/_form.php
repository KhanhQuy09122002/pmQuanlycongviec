<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\nhacungcap\models\NhaCungCap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nha-cung-cap-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
              <?= $form->field($model, 'ten_nha_cung_cap')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'so_dien_thoai')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
