<?php
use yii\helpers\Html;

$VTTT = $model->vatTuThanhToan; 
?>

<div class="vttt" id="vtttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/vat-tu-thanh-toan/create', 'idCT' => $model->id], 
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
            <th style="width: 40px;text-align: center;">#</th>
            <th style="width: 200px;text-align: center;">Tên vật tư</th>
            <th style="width: 200px;text-align: center;">Số lượng</th>
            <th style="width: 200px;text-align: center;">Đơn giá</th>
            <th style="width: 200px;text-align: center;">Thành tiền</th>
            <th style="width: 200px;text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($VTTT)): ?>
            <?php foreach ($VTTT as $index => $item): ?>
                <tr>
                    <td style="text-align: center;"><?= $index + 1 ?></td>
                    <td style="text-align: center;"><?=$item->ten_vat_tu ?></td>
                    <td style="text-align: center;"><?=$item->so_luong ?></td>
                    <td style="text-align: center;"><?= number_format($item->don_gia, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td style="text-align: center;"><?= number_format($item->thanh_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td style="text-align: center;">
                    
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/congtrinh/vat-tu-thanh-toan/update', 'id' => $item->id, 'idCT'=>$model->id], 
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

