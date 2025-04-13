<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\khachhang\models\CongNoKhachHang */
?>
<div class="cong-no-khach-hang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_khach_hang',
            'loai_cong_no',
            'so_tien',
            'ghi_chu:ntext',
            'ngay_phat_sinh',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
