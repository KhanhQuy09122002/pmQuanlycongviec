<?php
use yii\helpers\Html;


?>

<div class="ncttls" id="ncttlsContent">
    <div class="mb-3">
        <?= Html::a('<i class="fa fa-plus"></i> Thêm', 
            ['/congtrinh/nhan-cong-thanh-toan-ls/create', 'idCongTrinh' => $idCongTrinh], 
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
                <th style="width: 200px;text-align: center;">Nhân công</th>
                <th style="width: 200px;text-align: center;">Ngày thanh toán</th>
                <th style="width: 200px;text-align: center;">Số tiền</th>
                <th style="width: 200px;text-align: center;">Ghi chú</th>
                <th style="width: 200px;text-align: center;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($NCTTLS)): ?>
        <?php 
            $tongSoTien = 0;
            foreach ($NCTTLS as $index => $item): 
                $tongSoTien += $item->so_tien;
        ?>
            <tr>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= $item->nhanCongThanhToan ? $item->nhanCongThanhToan->ho_ten : '' ?></td>
                <td style="text-align: center;"><?= Yii::$app->formatter->asDate($item->ngay_thanh_toan, 'php:d/m/Y') ?></td>
                <td style="text-align: center;">
                    <?= number_format($item->so_tien, 0, ',', '.') ?> VNĐ
                </td>
                <td style="text-align: center;"><?= $item->ghi_chu ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                        ['/congtrinh/nhan-cong-thanh-toan-ls/update', 'id' => $item->id, 'idCongTrinh' => $idCongTrinh], 
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
                Tổng: <?= number_format($tongSoTien, 0, ',', '.') . ' VNĐ' ?>
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
