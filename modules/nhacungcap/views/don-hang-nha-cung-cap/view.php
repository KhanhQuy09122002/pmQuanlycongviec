<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\nhacungcap\models\DonHangNhaCungCap */
?>
<div class="don-hang-nha-cung-cap-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_nha_cung_cap',
            'so_don_hang',
            'ngay_dat_hang',
            'tong_tien',
            'da_giao_hang',
            'ngay_giao_hang',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
