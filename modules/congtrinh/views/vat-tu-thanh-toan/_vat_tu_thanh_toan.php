<?php
use yii\helpers\Html;
?>

<div class="vttt" id="vtttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/vat-tu-thanh-toan/create', 'idCT' => $modelCT->id], 
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
            <th style="width: 100px;">Tên vật tư</th>
            <th style="width: 100px;">Số lượng</th>
            <th style="width: 100px;">Đơn giá</th>
            <th style="width: 100px;">Thành tiền</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($VTTT)): ?>
            <?php foreach ($VTTT as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?=$item->ten_vat_tu ?></td>
                    <td><?=$item->so_luong ?></td>
                    <td style="text-align: left;"><?= number_format($item->don_gia, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td style="text-align: left;"><?= number_format($item->thanh_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td>
                    
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/congtrinh/vat-tu-thanh-toan/update', 'id' => $item->id, 'idCT'=>$modelCT->id], 
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

