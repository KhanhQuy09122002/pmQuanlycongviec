<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\ThauPhuThanhToan */
?>
<div class="thau-phu-thanh-toan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cong_trinh',
            'ten_cong_viec',
            'tong_hop_dong',
            'da_thanh_toan',
            'con_lai',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
