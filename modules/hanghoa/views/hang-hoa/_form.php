<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\custom\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\hanghoa\models\HangHoa */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
     $model->ngay_san_xuat = CustomFunc::convertYMDToDMY($model->ngay_san_xuat);
?>
<div class="hang-hoa-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
             <?= $form->field($model, 'ten_hang_hoa')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'ma_hang_hoa')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ngay_san_xuat')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
             'value' => $model->ngay_san_xuat ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
             ]
            ]); ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'so_luong_ton_kho')->textInput() ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'don_gia')->textInput() ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
