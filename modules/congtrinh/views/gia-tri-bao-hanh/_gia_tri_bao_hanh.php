<?php
use yii\helpers\Html;
?>

<div class="gtbh" id="gtbhContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/gia-tri-bao-hanh/create', 'idCT' => $modelCT->id], 
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
            <th style="width: 200px;text-align: center;">Số tiền</th>
            <th style="width: 200px;text-align: center;">Ngày tháng bảo hành</th>
            <th style="width: 200px;text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($GTBH)): ?>
        <?php 
            $tongSoTien = 0;
            foreach ($GTBH as $index => $item): 
                $tongSoTien += $item->so_tien;
        ?>
            <tr>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= number_format($item->so_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                <td style="text-align: center;"><?= date('d/m/Y', strtotime($item->ngay_thang_bao_hanh)) ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                        ['/congtrinh/gia-tri-bao-hanh/update', 'id' => $item->id, 'idCT'=>$modelCT->id], 
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
            <td colspan="4" style="text-align: right; font-weight: bold;">
                Tổng: <?= number_format($tongSoTien, 0, ',', '.') . ' VNĐ' ?>
            </td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="4" class="text-center text-muted">Không có dữ liệu.</td>
        </tr>
    <?php endif; ?>
</tbody>

</table>
</div>

