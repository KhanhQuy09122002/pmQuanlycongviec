<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\VatTuThanhToan */
?>
<div class="vat-tu-thanh-toan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cong_trinh',
            'ten_vat_tu',
            'so_luong',
            'don_gia',
            'thanh_tien',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
