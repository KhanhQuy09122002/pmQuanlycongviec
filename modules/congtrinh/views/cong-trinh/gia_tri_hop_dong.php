<?php
use yii\helpers\Html;
?>

<div class="d-flex justify-content-between align-items-center alert alert-info fw-bold" id="gthdContent">
    <div>
        Giá trị hợp đồng: 
        <span class="text-danger">
            <?= number_format($model->gia_tri_hop_dong, 0, ',', '.') ?> VNĐ
        </span>
    </div>
    <div class="ms-3"> 
        <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
            ['/congtrinh/cong-trinh/update-gtct', 'id' => $model->id],
            [
                'class' => 'btn btn-warning fw-bold',
                'style' => 'color: white;',
                'title' => 'Sửa giá trị hợp đồng',
                'role' => 'modal-remote-2'
            ]
        ) ?>
    </div>
</div>


