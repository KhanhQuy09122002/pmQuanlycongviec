<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\GiaTriThucHienHopDong */
?>
<div class="gia-tri-thuc-hien-hop-dong-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cong_trinh',
            'so_tien',
            'ngay_thang_bao_lanh',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
