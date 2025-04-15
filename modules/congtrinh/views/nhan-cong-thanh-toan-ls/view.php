<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\NhanCongThanhToanLs */
?>
<div class="nhan-cong-thanh-toan-ls-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_nhan_cong_thanh_toan',
            'ngay_thanh_toan',
            'so_tien',
            'ghi_chu:ntext',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
