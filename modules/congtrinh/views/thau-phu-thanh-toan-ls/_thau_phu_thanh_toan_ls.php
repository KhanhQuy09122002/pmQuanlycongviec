<?php
use yii\helpers\Html;
?>

<div class="tpttls" id="tpttlsContent">
    <div class="mb-3">
        <?= Html::a('<i class="fa fa-plus"></i> Thêm', 
            ['/congtrinh/thau-phu-thanh-toan-ls/create', 'idCongTrinh' => $idCongTrinh], 
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
                <th style="width: 100px;">Thầu phụ thanh toán</th>
                <th style="width: 100px;">Ngày thanh toán</th>
                <th style="width: 100px;">Số tiền</th>
                <th style="width: 100px;">Ghi chú</th>
                <th style="width: 100px;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($TPTTLS)): ?>
                <?php foreach ($TPTTLS as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item->thauPhuThanhToan ? $item->thauPhuThanhToan->ten_cong_viec : '' ?></td>
                        <td><?= Yii::$app->formatter->asDate($item->ngay_thanh_toan, 'php:d/m/Y') ?></td>
                        <td style="text-align: left;">
                            <?= number_format($item->so_tien, 0, ',', '.') ?> VNĐ
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                                ['/congtrinh/thau-phu-thanh-toan-ls/update', 'id' => $item->id, 'idCongTrinh' => $idCongTrinh], 
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
