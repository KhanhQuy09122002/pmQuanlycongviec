<?php
use yii\helpers\Html;

?>

<div class="cpktt" id="cpkttContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/chi-phi-khac-thanh-toan/create', 'idCT' => $modelCT->id], 
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
            <th style="width: 200px;text-align: center;">Tên chi phí</th>
            <th style="width: 200px;text-align: center;">Số tiền</th>
            <th style="width: 200px;text-align: center;">Ghi chú</th>
            <th style="width: 200px;text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($CPKTT)): ?>
        <?php 
            $tongSoTien = 0; // Biến để cộng dồn tổng tiền
            foreach ($CPKTT as $index => $item): 
                $tongSoTien += $item->so_tien; // Cộng dồn số tiền
        ?>
            <tr>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= $item->ten_chi_phi ?></td>
                <td style="text-align: center;">
                    <?= number_format($item->so_tien, 0, ',', '.') . ' VNĐ' ?>
                </td>
                <td style="text-align: center;"><?= $item->ghi_chu ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                        ['/congtrinh/chi-phi-khac-thanh-toan/update', 'id' => $item->id, 'idCT' => $modelCT->id], 
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
            <td colspan="5" style="text-align: right; font-weight: bold;">
                Tổng: <?= number_format($tongSoTien, 0, ',', '.') . ' VNĐ' ?>
            </td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center text-muted">Không có dữ liệu.</td>
        </tr>
    <?php endif; ?>
</tbody>

</table>
</div>

