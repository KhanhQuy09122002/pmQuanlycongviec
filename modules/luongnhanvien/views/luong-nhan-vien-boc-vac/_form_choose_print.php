<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form-print-options">
    <?php $form = ActiveForm::begin([
        'id' => 'form-print',
        'action' => ['print-preview'],
        'method' => 'get',
        'options' => ['target' => '_blank']
    ]); ?>

    <div class="row">
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'id_nhan_vien', [
                'labelOptions' => ['class' => 'fw-bold']
            ])->dropDownList($nhanVienList, ['prompt'=>'-- Chọn nhân viên --'])->label('Nhân viên') ?>
        </div>

        <div class="col-md-12 mb-3">
            <label class="fw-bold mb-2">Chọn kiểu in:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="chon_kieu" id="radio-thang" value="thang" checked>
                <label class="form-check-label" for="radio-thang">In theo tháng</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="chon_kieu" id="radio-khoang" value="khoang">
                <label class="form-check-label" for="radio-khoang">In theo khoảng ngày</label>
            </div>
        </div>

        <div class="col-md-6 mb-3" id="field-thang">
            <?= $form->field($model, 'thang', [
                'labelOptions' => ['class' => 'fw-bold']
            ])->input('month', ['class' => 'form-control'])->label('Tháng') ?>
        </div>

        <div class="col-md-6 mb-3" id="field-khoang">
            <div class="row">
                <div class="col-6">
                    <?= $form->field($model, 'tu_ngay', [
                        'labelOptions' => ['class' => 'fw-bold']
                    ])->input('date', ['class' => 'form-control'])->label('Từ ngày') ?>
                </div>
                <div class="col-6">
                    <?= $form->field($model, 'den_ngay', [
                        'labelOptions' => ['class' => 'fw-bold']
                    ])->input('date', ['class' => 'form-control'])->label('Đến ngày') ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<<JS
function toggleFields() {
    let isThang = $('#radio-thang').is(':checked');
    $('#field-thang').toggle(isThang);
    $('#field-khoang').toggle(!isThang);
    $('#form-print input[name="DynamicModel[thang]"]').prop('disabled', !isThang);
    $('#form-print input[name="DynamicModel[tu_ngay]"]').prop('disabled', isThang);
    $('#form-print input[name="DynamicModel[den_ngay]"]').prop('disabled', isThang);
}

$('#radio-thang, #radio-khoang').on('change', toggleFields);
toggleFields(); // chạy lần đầu khi load
JS;

$this->registerJs($script);
?>

