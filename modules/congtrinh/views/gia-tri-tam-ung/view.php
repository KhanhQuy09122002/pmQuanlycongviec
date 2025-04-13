<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\GiaTriTamUng */
?>
<div class="gia-tri-tam-ung-view">
 
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
