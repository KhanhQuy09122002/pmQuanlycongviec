<?php
use yii\helpers\Html;
?>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th class="text-center">Ngày tháng</th>
            <th class="text-center">Mức lương</th>
            <th>Ghi chú</th>
            <th class="text-center">Đã nhận</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model->getLuongs()->orderBy(['ngay_thang' => SORT_DESC])->all() as $luong): ?>
            <tr>
                <td><?= Yii::$app->formatter->asDate($luong->ngay_thang, 'php:d/m/Y') ?></td>
                <td class="text-end text-primary fw-bold">
                    <?= number_format($luong->so_tien, 0, ',', '.') ?> ₫
                </td>
                <td><?= Html::encode($luong->ghi_chu) ?></td>
                <td class="text-center">
                    <?= $luong->da_nhan 
                        ? '<span class="badge bg-success">Đã nhận</span>' 
                        : '<span class="badge bg-secondary">Chưa nhận</span>' ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if (count($model->luongs) === 0): ?>
            <tr>
                <td colspan="4" class="text-center text-muted">Chưa có dữ liệu lương cho nhân viên này.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
