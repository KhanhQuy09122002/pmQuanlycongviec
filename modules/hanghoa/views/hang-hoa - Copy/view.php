<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\hanghoa\models\HangHoa */
?>

<div class="card shadow-sm">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa fa-box-open"></i> Thông tin hàng hóa</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th style="width: 200px;">Tên hàng hóa</th>
                    <td><?= Html::encode($model->ten_hang_hoa) ?></td>
                </tr>
                <tr>
                    <th>Mã hàng hóa</th>
                    <td><?= Html::encode($model->ma_hang_hoa) ?></td>
                </tr>
                <tr>
                    <th>Ngày sản xuất</th>
                    <td><?= Yii::$app->formatter->asDate($model->ngay_san_xuat, 'php:d/m/Y') ?></td>
                </tr>
                <tr>
                    <th>Số lượng tồn kho</th>
                    <td><?= number_format($model->so_luong_ton_kho) ?></td>
                </tr>
                <tr>
                    <th>Đơn giá</th>
                    <td><?= number_format($model->don_gia, 0, ',', '.') ?> ₫</td>
                </tr>
                <tr>
                    <th>Ghi chú</th>
                    <td><?= nl2br(Html::encode($model->ghi_chu)) ?></td>
                </tr>
                <tr>
                    <th>Người tạo</th>
                    <td><?= Html::encode($model->nguoiTao ? $model->nguoiTao->username : 'Không rõ') ?></td>
                </tr>
                <tr>
                    <th>Thời gian tạo</th>
                    <td><?= Yii::$app->formatter->asDatetime($model->thoi_gian_tao, 'php:H:i d/m/Y') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

