<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\GiaTriDaThanhToan */
?>
<div class="gia-tri-da-thanh-toan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cong_trinh',
            'so_tien',
            'ten_lan_thanh_toan',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
