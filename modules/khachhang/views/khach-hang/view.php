<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\khachhang\models\KhachHang */
?>
<div class="khach-hang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ho_ten',
            'so_dien_thoai',
            'dia_chi',
            'tong_cong_no',
            'da_thanh_toan',
            'con_lai',
            'nguoi_tao',
            'thoi_gian_tao',
        ],
    ]) ?>

</div>
