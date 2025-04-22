<?php
use yii\helpers\Html;

?>

<div class="tptt" id="tpttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/thau-phu-thanh-toan/create', 'idCT' => $modelCT->id], 
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
            <th style="width: 200px;text-align: center;">Tên công việc</th>
            <th style="width: 200px;text-align: center;">Tổng hợp đồng</th>
            <th style="width: 200px;text-align: center;">Đã thanh toán</th>
            <th style="width: 200px;text-align: center;">Còn lại</th>
            <th style="width: 200px;text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($TPTT)): ?>
        <?php 
            $tongDaThanhToan = 0; // Biến để cộng dồn tổng tiền đã thanh toán
            foreach ($TPTT as $index => $item): 
                $tongDaThanhToan += $item->da_thanh_toan;
        ?>
            <tr>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= $item->ten_cong_viec ?></td>
                <td style="text-align: center;"><?= number_format($item->tong_hop_dong, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;"><?= number_format($item->da_thanh_toan, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;"><?= number_format($item->con_lai, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                        ['/congtrinh/thau-phu-thanh-toan/update', 'id' => $item->id, 'idCT' => $modelCT->id], 
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
        <tr>
            <td colspan="6" style="text-align: right; font-weight: bold;">
                Tổng đã thanh toán: <?= number_format($tongDaThanhToan, 0, ',', '.') . ' VNĐ' ?>
            </td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center text-muted">Không có dữ liệu.</td>
        </tr>
    <?php endif; ?>
</tbody>
>
</table>
</div>

