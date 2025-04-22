<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\custom\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\CongTrinh */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
     $model->thoi_han_hop_dong_tu_ngay = CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_tu_ngay);
     $model->thoi_han_hop_dong_den_ngay = CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_den_ngay);
?>
<div class="cong-trinh-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
              <?= $form->field($model, 'gia_tri_hop_dong')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
