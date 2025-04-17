<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\ThauPhuThanhToanLs */
?>
<div class="thau-phu-thanh-toan-ls-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_thau_phu_thanh_toan',
            'ngay_thanh_toan',
            'so_tien',
            'ghi_chu:ntext',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
