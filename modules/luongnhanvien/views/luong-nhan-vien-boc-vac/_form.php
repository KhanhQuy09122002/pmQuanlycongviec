<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\luongnhanvien\models\NhanVienBocVac;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\custom\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\luongnhanvien\models\LuongNhanVienBocVac */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
     $model->ngay_thang = CustomFunc::convertYMDToDMY($model->ngay_thang);
?>
<div class="luong-nhan-vien-boc-vac-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'id_nhan_vien_boc_vac')->widget(Select2::classname(), [
                  'data' => ArrayHelper::map(NhanVienBocVac::find()->all(), 'id', 'ho_ten'), 
                  'language' => 'vi', 
                  'options' => ['placeholder' => 'Chọn nhân viên...','id' => 'id_nhan_vien_boc_vac'], 
                  'pluginOptions' => [
                      'allowClear' => true, 
                      'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
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
     
        <div class="col-md-4">
              <?= $form->field($model, 'so_tien')->textInput(['id' => 'so_tien']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ghi_chu')->textInput() ?>
        </div>
        <div class="col-md-4">
               <?= $form->field($model, 'da_nhan', [
                  'template' => "{label}<br>{input}\n{error}",
                   ])->checkbox(['class' => 'form-check-input ','id'=>'gray-checkbox'], false) ?>
               </div>
        </div>
    </div>
  


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
use yii\helpers\Url;

$urlGetLuong = Url::to(['/luongnhanvien/luong-nhan-vien-boc-vac/get-luong']);

$script = <<<JS
    $('#id_nhan_vien_boc_vac').on('change', function() {
        var id = $(this).val();
        if (id) {
            $.get('$urlGetLuong', { id: id }, function(data) {
                if(data.muc_luong !== undefined) {
                $('#so_tien').val(data.muc_luong);
                } else {
                    $('#so_tien').val('');
                    alert('Không lấy được mức lương từ server.');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert('Lỗi khi gọi đến actionGetLuong: ' + textStatus);
                console.error('Lỗi:', errorThrown);
                console.error('Chi tiết:', jqXHR.responseText);
            });
        } else {
            $('#so_tien').val('');
        }
    });
JS;
$this->registerJs($script);
?>


