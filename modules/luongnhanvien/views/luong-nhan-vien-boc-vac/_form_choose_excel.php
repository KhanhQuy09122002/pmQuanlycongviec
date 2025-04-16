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
            <?= Html::label('Nhân viên', 'id_nhan_vien', ['class' => 'fw-bold']) ?>
            <?= Html::dropDownList('id_nhan_vien', null, $nhanVienList, ['class' => 'form-control', 'prompt' => '-- Chọn nhân viên --']) ?>
        </div>

        <div class="col-md-12 mb-3">
            <label class="fw-bold mb-2">Chọn kiểu xuất:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="chon_kieu" id="radio-thang" value="thang" checked>
                <label class="form-check-label" for="radio-thang">Xuất theo tháng</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="chon_kieu" id="radio-khoang" value="khoang">
                <label class="form-check-label" for="radio-khoang">Xuất theo khoảng ngày</label>
            </div>
        </div>

        <div class="col-md-6 mb-3" id="field-thang">
            <?= Html::label('Tháng', 'thang', ['class' => 'fw-bold']) ?>
            <?= Html::input('month', 'thang', null, ['class' => 'form-control']) ?>
        </div>

        <div class="col-md-6 mb-3" id="field-khoang" style="display:none">
            <div class="row">
                <div class="col-6">
                    <?= Html::label('Từ ngày', 'tu_ngay', ['class' => 'fw-bold']) ?>
                    <?= Html::input('date', 'tu_ngay', null, ['class' => 'form-control']) ?>
                </div>
                <div class="col-6">
                    <?= Html::label('Đến ngày', 'den_ngay', ['class' => 'fw-bold']) ?>
                    <?= Html::input('date', 'den_ngay', null, ['class' => 'form-control']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Xuất Excel', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<<JS
function toggleFields() {
    let isThang = $('#radio-thang').is(':checked');
    $('#field-thang').toggle(isThang);
    $('#field-khoang').toggle(!isThang);
}
$('#radio-thang, #radio-khoang').on('change', toggleFields);
toggleFields();
JS;
$this->registerJs($script);
?>
