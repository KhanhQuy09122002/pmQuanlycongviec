<?php
use yii\helpers\Html;
use app\custom\CustomFunc;
?>

<div id="gthdContent" class="gthd-card card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <div class="gthd-icon">
                    <i class="fa fa-file-invoice-dollar"></i>
                </div>
                <div>
                    <div class="gthd-title">Giá trị hợp đồng</div>
                    <div class="gthd-amount">
                        <span class="sTongTien"><?= number_format($model->gia_tri_hop_dong, 0, ',', '.') ?></span>
                        <span class="gthd-currency">VND</span>
                    </div>
                </div>
            </div>
            <div class="gthd-actions">
                <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                    ['/congtrinh/cong-trinh/update-gtct', 'id' => $model->id],
                    [
                        'class' => 'btn btn-sm btn-warning fw-bold',
                        'style' => 'color: white;',
                        'title' => 'Sửa giá trị hợp đồng',
                        'role' => 'modal-remote-2'
                    ]
                ) ?>
            </div>
        </div>

        <hr class="gthd-divider">

        <div class="row g-3">
            <div class="col-lg-6 col-md-12">
                <div class="gthd-info">
                    <div class="gthd-label">Địa điểm công trình</div>
                    <div class="gthd-value"><?= $model->dia_diem ?></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="gthd-info">
                    <div class="gthd-label">Thời hạn hợp đồng</div>
                    <div class="gthd-value">
                        Từ <?= CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_tu_ngay) ?>
                        đến <?= CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_den_ngay) ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="gthd-info">
                    <div class="gthd-label">Trạng thái</div>
                    <div class="gthd-value">
                        <span class="gthd-status">
                            <i class="fa fa-circle"></i>
                            <?= $model->trang_thai ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div id="dThongKeSum" class="gthd-summary mt-3 p-3">
            <?= $this->render('thong_ke_sum', ['model'=>$model]) ?>  
        </div>
    </div>
</div>
