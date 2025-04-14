<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\CaMayThanhToan */
?>
<div class="ca-may-thanh-toan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cong_trinh',
            'ten_ca_may',
            'so_tien',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
