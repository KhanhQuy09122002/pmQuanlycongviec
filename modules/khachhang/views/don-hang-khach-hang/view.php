<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\khachhang\models\DonHangKhachHang */
?>
<div class="don-hang-khach-hang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_khach_hang',
            'so_don_hang',
            'ngay_dat_hang',
            'tong_tien',
            'da_giao_hang',
            'ngay_giao_hang',
            'chi_phi_van_chuyen',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
