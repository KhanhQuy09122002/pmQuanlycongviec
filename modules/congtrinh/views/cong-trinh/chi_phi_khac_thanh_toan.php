<?php
use yii\helpers\Html;

$CPKTT = $model->chiPhiKhacThanhToan; 
?>

<div class="cpktt" id="cpkttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/chi-phi-khac-thanh-toan/create', 'idCT' => $model->id], 
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
            <th style="width: 100px;">Tên chi phí</th>
            <th style="width: 100px;">Số tiền</th>
            <th style="width: 100px;">Ghi chú</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($CPKTT)): ?>
            <?php foreach ($CPKTT as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?=$item->ten_chi_phi ?></td>
                    <td style="text-align: left;"><?= number_format($item->so_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td><?=$item->ghi_chu ?></td>
                    <td>
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/congtrinh/chi-phi-khac-thanh-toan/update', 'id' => $item->id, 'idCT'=>$model->id], 
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

