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
          <?= Html::button('<i class="fas fa-file-excel"></i> Xuất Excel', [
            'class' => 'btn btn-success',
            'onclick' => 'xuatExcelChiTiet()'
          ]) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    function xuatExcelChiTiet() {
    const idCongTrinh = $('#dynamicmodel-id_cong_trinh').val();

    if (!idCongTrinh) {
        alert('Vui lòng chọn công trình.');
        return;
    }

    // Điều hướng sang action xuất Excel
    window.open('/congtrinh/cong-trinh/export-excel?id=' + idCongTrinh, '_blank');
}

</script>