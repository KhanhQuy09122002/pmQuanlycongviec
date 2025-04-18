<?php
$this->registerCssFile('@web/css/cong-trinh.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::className()],
]);
/* @var $this yii\web\View */
/* @var $model app\modules\nhanvien\models\NhanVien */
?>
<div class="cong-trinh-view">
    <div class="row">
     <!-- Menu bên trái -->
<div class="col-xl-3 col-md-12">
    <div class="card custom-card shadow-sm">
        <div class="card-header custom-card-header rounded-top-0">
        <h6 class="card-title mb-0 text-center" style="color: #5D5FEF; font-weight: bold;">CHI TIẾT CÔNG TRÌNH</h6>
        </div>
        <div class="card-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="ct1-tab" data-bs-toggle="pill" href="#ct1" role="tab" aria-controls="ct1" aria-selected="true">
                        <i class="fa fa-file-contract"></i> Giá trị thực hiện hợp đồng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct2-tab" data-bs-toggle="pill" href="#ct2" role="tab" aria-controls="ct2" aria-selected="false">
                        <i class="fa fa-hand-holding-usd"></i> Giá trị tạm ứng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct3-tab" data-bs-toggle="pill" href="#ct3" role="tab" aria-controls="ct3" aria-selected="false">
                        <i class="fa fa-shield-alt"></i> Giá trị bảo hành
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct4-tab" data-bs-toggle="pill" href="#ct4" role="tab" aria-controls="ct4" aria-selected="false">
                        <i class="fa fa-money-check-alt"></i> Giá trị thanh toán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct5-tab" data-bs-toggle="pill" href="#ct5" role="tab" aria-controls="ct5" aria-selected="false">
                        <i class="fa fa-users-cog"></i> Nhân công thanh toán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct10-tab" data-bs-toggle="pill" href="#ct10" role="tab" aria-controls="ct10" aria-selected="false">
                        <i class="fas fa-history"></i> Nhân công thanh toán LS
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct6-tab" data-bs-toggle="pill" href="#ct6" role="tab" aria-controls="ct6" aria-selected="false">
                        <i class="fa fa-boxes"></i> Vật tư thanh toán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct7-tab" data-bs-toggle="pill" href="#ct7" role="tab" aria-controls="ct7" aria-selected="false">
                        <i class="fa fa-people-carry"></i> Thầu phụ thanh toán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct11-tab" data-bs-toggle="pill" href="#ct11" role="tab" aria-controls="ct11" aria-selected="false">
                        <i class="fas fa-history"></i> Thầu phụ thanh toán LS
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct8-tab" data-bs-toggle="pill" href="#ct8" role="tab" aria-controls="ct8" aria-selected="false">
                        <i class="fa fa-industry"></i> Ca máy thanh toán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ct9-tab" data-bs-toggle="pill" href="#ct9" role="tab" aria-controls="ct9" aria-selected="false">
                        <i class="fa fa-coins"></i> Chi phí khác đã thanh toán
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

       <!-- Nội dung bên phải -->
<div class="col-xl-9 col-md-12">
    <div class="card custom-card">
        <div class="card-header custom-card-header rounded-bottom-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ct1" role="tabpanel" aria-labelledby="ct1-tab">
                    <!-- Giá trị thực hiện hợp đồng -->
                    <?= $this->render('gia_tri_thuc_hien_hop_dong', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct2" role="tabpanel" aria-labelledby="ct2-tab">
                    <!-- Giá trị tạm ứng -->
                    <?= $this->render('gia_tri_tam_ung', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct3" role="tabpanel" aria-labelledby="ct3-tab">
                    <!-- Giá trị bảo hành -->
                    <?= $this->render('gia_tri_bao_hanh', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct4" role="tabpanel" aria-labelledby="ct4-tab">
                    <!-- Giá trị đã thanh toán -->
                    <?= $this->render('gia_tri_da_thanh_toan', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct5" role="tabpanel" aria-labelledby="ct5-tab">
                    <!-- Nhân công thanh toán -->
                    <?= $this->render('nhan_cong_thanh_toan', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct10" role="tabpanel" aria-labelledby="ct10-tab">
                    <!-- Nhân công thanh toán lịch sử -->
                    <?= $this->render('nhan_cong_thanh_toan_ls', ['idCongTrinh' => $model->id]) ?>
                </div>
                <div class="tab-pane fade" id="ct6" role="tabpanel" aria-labelledby="ct6-tab">
                    <!-- Vật tư thanh toán -->
                    <?= $this->render('vat_tu_thanh_toan', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct7" role="tabpanel" aria-labelledby="ct7-tab">
                    <!-- Thầu phụ thanh toán -->
                    <?= $this->render('thau_phu_thanh_toan', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct11" role="tabpanel" aria-labelledby="ct11-tab">
                    <!-- Thầu phụ thanh toán lịch sử -->
                    <?= $this->render('thau_phu_thanh_toan_ls', ['idCongTrinh' => $model->id]) ?>
                </div>
                <div class="tab-pane fade" id="ct8" role="tabpanel" aria-labelledby="ct8-tab">
                    <!-- Ca máy thanh toán -->
                    <?= $this->render('ca_may_thanh_toan', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct9" role="tabpanel" aria-labelledby="ct9-tab">
                    <!-- Chi phí khác thanh toán -->
                    <?= $this->render('chi_phi_khac_thanh_toan', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


