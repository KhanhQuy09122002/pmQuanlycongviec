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
<p>
    <?= Html::button('<i class="fa fa-print"></i> In bảng lương', [
        'class' => 'btn btn-success',
        'onclick' => 'inBangLuong()'
    ]) ?>
</p>

<!-- Phần tử ẩn chứa nội dung in -->
<div style="display:none">
    <div id="print-bang-luong"></div>
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
<script>
function inBangLuong() {
    const idNhanVien = $('#dynamicmodel-id_nhan_vien').val();
    const kieuIn = $('input[name="chon_kieu"]:checked').val();
    const thang = $('#dynamicmodel-thang').val();
    const tuNgay = $('#dynamicmodel-tu_ngay').val();
    const denNgay = $('#dynamicmodel-den_ngay').val();

    $.ajax({
        type: 'GET',
        url: '/luongnhanvien/luong-nhan-vien-boc-vac/get-print-content',
        data: {
            id: idNhanVien,
            kieu: kieuIn,
            thang: thang,
            tu_ngay: tuNgay,
            den_ngay: denNgay
        },
        success: function (data) {
            if (data.status === 'success') {
                $('#print-bang-luong').html(data.content);
                printBangLuong();
            } else {
                alert('Không thể tải nội dung in.');
            }
        },
        error: function (xhr, status, error) {
    console.error('AJAX Error:', xhr);
    console.error('Status:', status);
    console.error('Error:', error);
    
    let message = 'Đã xảy ra lỗi khi in.\n';
    message += 'Trạng thái: ' + status + '\n';
    message += 'Lỗi: ' + error + '\n';

    // Nếu server có trả về lỗi dạng HTML hoặc JSON
    if (xhr.responseText) {
        message += 'Phản hồi server:\n' + xhr.responseText;
    }

    alert(message);
}

    });
}

function printBangLuong() {
    var printContents = document.getElementById('print-bang-luong').innerHTML;

    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0px';
    iframe.style.height = '0px';
    iframe.style.border = 'none';
    document.body.appendChild(iframe);

    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write(`
        <html>
            <head>
                <title>In bảng lương</title>
                 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    table { border-collapse: collapse; width: 100%; }
                    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                </style>
            </head>
            <body>
                ${printContents}
            </body>
        </html>
    `);
    doc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(() => document.body.removeChild(iframe), 1000);
}
</script>

