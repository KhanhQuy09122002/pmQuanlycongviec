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
              <?= $form->field($model, 'ten_cong_trinh')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'dia_diem')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'thoi_han_hop_dong_tu_ngay')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
             'value' => $model->thoi_han_hop_dong_tu_ngay ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
             ]
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'thoi_han_hop_dong_den_ngay')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
             'value' => $model->thoi_han_hop_dong_den_ngay ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
             ]
            ]); ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'trang_thai')->dropDownList([
               'Sắp thi công' => 'Sắp thi công',
               'Đang thi công' => 'Đang thi công',
               'Đã hoàn thành' => 'Đã hoàn thành',
             ], ['prompt' => '--- Chọn trạng thái ---']) ?>
        </div>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
