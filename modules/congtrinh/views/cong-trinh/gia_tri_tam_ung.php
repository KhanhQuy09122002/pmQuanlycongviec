<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

$GTTHHD = $model->giaTriTamUng; 
?>

<div class="gttu" id="gttuContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/gia-tri-tam-ung/create', 'idCT' => $model->id], 
        [
            'class' => 'btn fw-bold btn-warning',
            'style' => 'color: white;',
            'role' => 'modal-remote-2', 
            'title' => 'Thêm'
        ]
    ) ?>
</div>


<table class="table table-bordered table-hover table-striped">
    <thead class="table-light">
        <tr>
            <th style="width: 40px;">#</th>
            <th style="width: 100px;">Số tiền</th>
            <th style="width: 100px;">Ngày tháng bảo lãnh</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($GTTHHD)): ?>
            <?php foreach ($GTTHHD as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td style="text-align: left;"><?= number_format($item->so_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td><?= date('d/m/Y', strtotime($item->ngay_thang_bao_lanh)) ?></td>
                    <td>
                    
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/congtrinh/gia-tri-tam-ung/update', 'id' => $item->id, 'idCT'=>$model->id], 
                               [
                                  'class' => 'btn fw-bold btn-warning',
                                  'style' => 'color: white;',
                                  'role' => 'modal-remote-2', 
                                  'title' => 'Sửa'
                               ]
                         ) ?>
        
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center text-muted">Không có dữ liệu.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

