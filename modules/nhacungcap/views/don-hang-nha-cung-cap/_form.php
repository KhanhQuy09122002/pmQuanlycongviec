<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\nhacungcap\models\DonHangNhaCungCap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="don-hang-nha-cung-cap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_nha_cung_cap')->textInput() ?>

    <?= $form->field($model, 'so_don_hang')->textInput() ?>

    <?= $form->field($model, 'ngay_dat_hang')->textInput() ?>

    <?= $form->field($model, 'tong_tien')->textInput() ?>

    <?= $form->field($model, 'da_giao_hang')->textInput() ?>

    <?= $form->field($model, 'ngay_giao_hang')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'thoi_gian_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
