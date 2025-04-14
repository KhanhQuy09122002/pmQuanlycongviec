<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\GiaTriThucHienHopDong */
/* @var $form yii\widgets\ActiveForm */
use kartik\date\DatePicker;
use app\custom\CustomFunc;

?>
<?php
     $model->ngay_thang_bao_hanh = CustomFunc::convertYMDToDMY($model->ngay_thang_bao_hanh);
?>


<div class="gia-tri-bao-hanh-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'so_tien')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ngay_thang_bao_hanh')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
             'value' => $model->ngay_thang_bao_hanh ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
             ]
            ]); ?>
        </div>
    </div>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
