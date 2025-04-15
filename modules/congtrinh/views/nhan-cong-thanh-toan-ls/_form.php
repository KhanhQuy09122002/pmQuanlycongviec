<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\congtrinh\models\NhanCongThanhToan;
/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\NhanCongThanhToanLs */
/* @var $form yii\widgets\ActiveForm */

use kartik\date\DatePicker;
use app\custom\CustomFunc;
?>

<?php
     $model->ngay_thanh_toan = CustomFunc::convertYMDToDMY($model->ngay_thanh_toan);
?>

<div class="nhan-cong-thanh-toan-ls-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
         <div class="col-md-4">
            <?= $form->field($model, 'id_nhan_cong_thanh_toan')->widget(Select2::classname(), [
                  'data' => ArrayHelper::map(NhanCongThanhToan::find()->all(), 'id', 'ho_ten'), 
                  'language' => 'vi', 
                  'options' => ['placeholder' => 'Chọn nhân công thanh toán...','id' => 'id_nhan_vien_thanh_toan'], 
                  'pluginOptions' => [
                      'allowClear' => true, 
                      'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
                      'containerCssClass' => 'select2-dropdown-adjustment', 
                     ],
            ]); ?>
         </div>
         <div class="col-md-4">
            <?= $form->field($model, 'ngay_thanh_toan')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
             'value' => $model->ngay_thanh_toan ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
             ]
            ]); ?>
         </div>
         <div class="col-md-4">
               <?= $form->field($model, 'so_tien')->textInput() ?>
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
