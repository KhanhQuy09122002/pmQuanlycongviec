<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

?>

<div class="khach-hang-search">

<?php $form = ActiveForm::begin([
        'id' => 'myFilterForm',
        'method' => 'get', 
        'options' => [
            'class' => 'myFilterForm'
        ]
]); ?>

<div class="row">
         <div class="col-md-4">
               <?= $form->field($model, 'ho_ten')->textInput(['maxlength' => true]) ?>
         </div>
         <div class="col-md-4">
               <?= $form->field($model, 'so_dien_thoai')->textInput(['maxlength' => true]) ?>
         </div>
         <div class="col-md-4">
               <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true]) ?>
         </div>
   </div>
<?php if (!Yii::$app->request->isAjax){ ?>
    <div class="col-md-12 text-left">
        <div class="form-group mb-0">
	        <?= Html::submitButton('<i class="fe fe-search"></i> Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('<i class="fe fe-x"></i> Xóa tìm kiếm', ['class' => 'btn btn-info']) ?>
	    </div>
    </div>
<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<style>
.khach-hang-search label {
    font-weight: bold;
 
}
</style>
