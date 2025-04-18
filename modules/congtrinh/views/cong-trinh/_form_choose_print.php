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
            <?= $form->field($model, 'id_cong_trinh', [
                'labelOptions' => ['class' => 'fw-bold']
            ])->dropDownList($congTrinhList, ['prompt'=>'-- Chọn công trình --'])->label('Công trình') ?>
        </div>

        <div class="text-end">
           <?= Html::button('<i class="fas fa-print"></i> In chi tiết', [
            'class' => 'btn btn-primary',
            'onclick' => 'inChiTietCongTrinh()'
           ]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>


<!-- Phần tử ẩn chứa nội dung in -->
<div style="display:none">
    <div id="print-cong-trinh"></div>
</div>

<script>
function inChiTietCongTrinh() {
    const idCongTrinh = $('#dynamicmodel-id_cong_trinh').val();

    if (!idCongTrinh) {
        alert('Vui lòng chọn công trình.');
        return;
    }

    $.ajax({
        type: 'GET',
        url: '/congtrinh/cong-trinh/get-print-content',
        data: { id: idCongTrinh },
        success: function (data) {
            if (data.status === 'success') {
                $('#print-cong-trinh').html(data.content);
                printCongTrinh();
            } else {
                alert(data.message || 'Không thể tải nội dung in.');
            }
        },
        error: function (xhr, status, error) {
            alert('Lỗi khi tải nội dung in: ' + error);
        }
    });
}

function printCongTrinh() {
    var printContents = document.getElementById('print-cong-trinh').innerHTML;

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
                <title>In công trình</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h2 { margin-bottom: 20px; }
                    p { margin: 5px 0; }
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

