<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\modules\luongnhanvien\models\NhanVienBocVac;
?>

<div class="luong-search">

<?php $form = ActiveForm::begin([
        'id' => 'myFilterForm',
        'method' => 'get', 
        'options' => [
            'class' => 'myFilterForm'
        ]
]); ?>

<div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'id_nhan_vien_boc_vac')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(NhanVienBocVac::find()->all(), 'id', 'ho_ten'), 
            'language' => 'vi', 
            'options' => [
            'placeholder' => 'Chọn nhân viên...',
            'id' => 'id_nhan_vien_boc_vac'
        ], 
          'pluginOptions' => [
          'allowClear' => true, 
          'width' => '100%',
          'containerCssClass' => 'select2-dropdown-adjustment', 
        ],
        ]); ?>

        </div>
        <div class="col-md-4">
           <?= $form->field($model, 'ngay_thang')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
             'value' => $model->ngay_thang ?: date('d/m/Y'),
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
             ]
            ]); ?>
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
.luong-search label {
    font-weight: bold;
 
}
</style>
