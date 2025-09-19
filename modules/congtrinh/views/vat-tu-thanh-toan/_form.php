<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\custom\CustomFunc;
use kartik\select2\Select2;
use app\modules\hanghoa\models\HangHoa;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\VatTuThanhToan */
/* @var $form yii\widgets\ActiveForm */
$model->ngay_thanh_toan = CustomFunc::convertYMDToDMY($model->ngay_thanh_toan);
?>

<div class="vat-tu-thanh-toan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-4">
    		<label>Vật tư</label>
            <?= $form->field($model, 'id_hang_hoa')->widget(Select2::classname(), [
                'data' => HangHoa::getDmHangHoa(),
                'language' => 'vi',
                'options' => [
                    'placeholder' => 'Chọn vật tư...',  
                    'class' => 'form-control dropdown-with-arrow',
                    'id' => 'hh-dropdown'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                    'width'=>'100%'
                ],
            ])->label(false); ?>
        </div>
    	 <div class="col-md-4">
            <?= $form->field($model, 'ten_vat_tu')->textInput(['maxlength' => true, 'id'=>'txtTenVatTu']) ?>
        </div>        
        <div class="col-md-4">
            <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true, 'id'=>'txtDonViTinh']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ngay_thanh_toan')->widget(DatePicker::classname(), [
             'options' => [
             'placeholder' => 'Chọn ngày ...',
                 'value' => $model->ngay_thanh_toan,
              ],
             'pluginOptions' => [
             'autoclose' => true,
             'format' => 'dd/mm/yyyy',
                 'todayHighlight'=>true,
                 'todayBtn'=>true
             ]
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'so_luong')->textInput(['id' => 'so-luong', 
                'value'=>$model->so_luong?$model->so_luong:0]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'don_gia')->textInput(['id' => 'don-gia']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'thanh_tien')->textInput(['id' => 'thanh-tien', 'readonly' => true]) ?>
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


<script>

function tinhThanhTien() {
    let soLuong = parseFloat($('#so-luong').val().replace(/,/g, '')) || 0;
    let donGia = parseFloat($('#don-gia').val().replace(/,/g, '')) || 0;
    let thanhTien = soLuong * donGia;
    $('#thanh-tien').val(thanhTien);
}

$('#so-luong, #don-gia').on('keyup change', function() {
    tinhThanhTien();
});

function getVatTuAjax(idvt){
    $.ajax({
        type: 'post',
        url: '/congtrinh/vat-tu-thanh-toan/get-vat-tu-ajax?idvt=' + idvt,
        //data: frm.serialize(),
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);            
            if(data.status == 'success'){
            	$('#txtTenVatTu').val(data.vtTenVatTu);
            	$('#txtDonViTinh').val(data.vtDonViTinh);
            	$('#don-gia').val(data.vtDonGia);
            	tinhThanhTien();
            } else {
            	alert('Thông tin vật tư không còn tồn tại trên hệ thống!');
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });
}
function clearInfoVatTu(){
	$('#txtTenVatTu').val('');
	$('#txtDonViTinh').val('');
	$('#don-gia').val('');
}
    	
$('#hh-dropdown').on("select2:select", function(e) { 
   if(this.value != ''){
   		getVatTuAjax(this.value);
   } else {
   		clearInfoVatTu();
   }
});
$('#hh-dropdown').on('select2:clear', function(e) {
    clearInfoVatTu();
});
</script>
