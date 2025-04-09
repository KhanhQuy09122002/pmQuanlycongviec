<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\luongnhanvien\models\LuongNhanVienBocVac */
?>
<div class="luong-nhan-vien-boc-vac-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_nhan_vien_boc_vac',
            'ngay_thang',
            'so_tien',
            'da_nhan',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
