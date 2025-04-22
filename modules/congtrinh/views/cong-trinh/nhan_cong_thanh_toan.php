<?php
use yii\helpers\Html;

$NCTT = $model->nhanCongThanhToan; 
?>

<div class="nctt" id="ncttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/nhan-cong-thanh-toan/create', 'idCT' => $model->id], 
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
            <th style="width: 200px;text-align: center;">Họ tên</th>
            <th style="width: 200px;text-align: center;">Tổng hợp đồng</th>
            <th style="width: 200px;text-align: center;">Đã thanh toán</th>
            <th style="width: 200px;text-align: center;">Còn lại</th>
            <th style="width: 200px;text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($NCTT)): ?>
        <?php 
            $tongDaThanhToan = 0; // Biến để cộng dồn tổng tiền đã thanh toán
            foreach ($NCTT as $index => $item): 
                $tongDaThanhToan += $item->da_thanh_toan;
        ?>
            <tr>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= $item->ho_ten ?></td>
                <td style="text-align: center;"><?= number_format($item->tong_hop_dong, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;"><?= number_format($item->da_thanh_toan, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;"><?= number_format($item->con_lai, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                        ['/congtrinh/nhan-cong-thanh-toan/update', 'id' => $item->id, 'idCT'=>$model->id], 
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
                Tổng thanh toán: <?= number_format($tongDaThanhToan, 0, ',', '.') . ' VNĐ' ?>
            </td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center text-muted">Không có dữ liệu.</td>
        </tr>
    <?php endif; ?>
</tbody>


</table>
</div>

