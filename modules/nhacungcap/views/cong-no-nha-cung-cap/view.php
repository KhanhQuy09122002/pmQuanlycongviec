<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\nhacungcap\models\CongNoNhaCungCap */
?>
<div class="cong-no-nha-cung-cap-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_nha_cung_cap',
            'loai_cong_no',
            'so_tien',
            'ghi_chu:ntext',
            'ngay_phat_sinh',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
