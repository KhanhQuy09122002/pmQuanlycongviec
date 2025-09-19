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
     $model->ngay_thang_bao_lanh = CustomFunc::convertYMDToDMY($model->ngay_thang_bao_lanh);
?>


<div class="gia-tri-tam-ung-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'so_tien')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ngay_thang_bao_lanh')->widget(DatePicker::classname(), [
             'options' => [
                 'placeholder' => 'Chọn ngày ...',
                 'value' => $model->ngay_thang_bao_lanh,
             ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
                 'todayHighlight'=>true,
                 'todayBtn'=>true
             ]
            ]); ?>
        </div>
         <div class="col-md-12">
              <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>
        </div>
    </div>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
