<?php
use yii\helpers\Html;
?>

<div class="gttt" id="gtttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/gia-tri-da-thanh-toan/create', 'idCT' => $modelCT->id], 
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
            <th style="width: 40px; text-align: center;">#</th>
            <th style="width: 200px; text-align: center;">Tên lần thanh toán</th>
            <th style="width: 200px;text-align: center;">Số tiền</th>
            <th style="width: 200px;text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($GTTT)): ?>
            <?php foreach ($GTTT as $index => $item): ?>
                <tr>
                    <td style="text-align: center;"><?= $index + 1 ?></td>
                    <td style="text-align: center;"><?=$item->ten_lan_thanh_toan ?></td>
                    <td style="text-align: center;"><?= number_format($item->so_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td style="text-align: center;">
                    
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/congtrinh/gia-tri-da-thanh-toan/update', 'id' => $item->id, 'idCT'=>$modelCT->id], 
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

