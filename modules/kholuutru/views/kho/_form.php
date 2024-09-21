<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\Kho */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kho-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten_kho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'so_do_kho')->textInput(['maxlength' => true]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<style>
 .kho-form label {
    font-weight: bold;
}
</style>