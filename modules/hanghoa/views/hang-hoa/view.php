<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\hanghoa\models\HangHoa */
?>
<div class="hang-hoa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_hang_hoa',
            'ma_hang_hoa',
            'ngay_san_xuat',
            'so_luong_ton_kho',
            'don_gia',
            'ghi_chu:ntext',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
