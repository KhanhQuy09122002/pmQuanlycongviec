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

    <div class="form-group">
        <?= Html::button('Xuất Excel', ['class' => 'btn btn-success', 'id' => 'export-excel']) ?>
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

// Handle export to Excel
$('#export-excel').on('click', function() {
    const idNhanVien = $('#dynamicmodel-id_nhan_vien').val();
    const kieuIn = $('input[name="chon_kieu"]:checked').val();
    const thang = $('#dynamicmodel-thang').val();
    const tuNgay = $('#dynamicmodel-tu_ngay').val();
    const denNgay = $('#dynamicmodel-den_ngay').val();

    $.ajax({
        type: 'GET',
        url: '/luongnhanvien/luong-nhan-vien-boc-vac/export-excel',
        data: {
            id: idNhanVien,
            kieu: kieuIn,
            thang: thang,
            tu_ngay: tuNgay,
            den_ngay: denNgay
        },
        success: function(data) {
            if (data.status === 'success') {
                // Create a link to download the Excel file
                var link = document.createElement('a');
                link.href = data.fileUrl; // Đảm bảo server trả về URL file Excel
                link.download = 'bang_luong.xlsx';
                link.click();
            } else {
                alert('Không thể xuất file Excel.');
            }
        },
        error: function() {
            alert('Đã xảy ra lỗi khi xuất Excel.');
        }
    });
});
JS;

$this->registerJs($script);
?>
