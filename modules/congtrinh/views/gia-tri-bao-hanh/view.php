<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\GiaTriBaoHanh */
?>
<div class="gia-tri-bao-hanh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_cong_trinh',
            'so_tien',
            'ngay_thang_bao_hanh',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
