<?php
use yii\helpers\Html;


?>

<div class="nctt" id="ncttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/nhan-cong-thanh-toan/create', 'idCT' => $modelCT->id], 
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
            <th style="width: 100px;">Họ tên</th>
            <th style="width: 100px;">Tổng hợp đồng</th>
            <th style="width: 100px;">Đã thanh toán</th>
            <th style="width: 100px;">Còn lại</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($NCTT)): ?>
            <?php foreach ($NCTT as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $item->ho_ten ?></td>
                    <td style="text-align: left;"><?= number_format($item->tong_hop_dong, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td style="text-align: left;"><?= number_format($item->da_thanh_toan, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td style="text-align: left;"><?= number_format($item->con_lai, 0, ',', '.') . ' VNĐ' ?> </td>
                 
                    <td>
                    
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/congtrinh/nhan-cong-thanh-toan/update', 'id' => $item->id, 'idCT'=>$modelCT->id], 
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

