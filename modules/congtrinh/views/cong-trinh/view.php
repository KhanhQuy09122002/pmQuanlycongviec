<?php
use app\widgets\FileDisplayWidget;
use app\modules\nhanvien\models\NhanVien;
use app\widgets\KhoDisplayWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\nhanvien\models\NhanVien */
?>
<div class="nhan-vien-view">
 
<div class="row">
    <div class="col-xl-3 col-md-12">
    <div class="card custom-card">
				<div class="card-header custom-card-header rounded-bottom-0">
					<div>
						<h6 class="card-title mb-0 "style="color: red;">Thông tin công trình: </h6>
					</div>
			    </div>
							<div class="card-body">
									<div class="skill-tags">
                                        <p><strong>Tên công trình :</strong> <?= $model->ten_cong_trinh ?></p>
                                        <p><strong>Địa điểm:</strong> <?= $model->dia_diem?></p>
                                        <p><strong>Hợp đồng từ ngày:</strong> <?= Yii::$app->formatter->asDate($model->thoi_han_hop_dong_tu_ngay, 'php:d-m-Y') ?></p>
                                        <p><strong>Hợp đồng đến ngày:</strong> <?= Yii::$app->formatter->asDate($model->thoi_han_hop_dong_den_ngay, 'php:d-m-Y') ?></p>
								    </div>
						    </div>
	</div>
</div>
        <div class="col-xl-9 col-md-12">
                           
		<div class="card custom-card">
            <div class="card-header custom-card-header rounded-bottom-0">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="ct1-tab" data-bs-toggle="tab" href="#ct1" role="tab" aria-controls="ct1" aria-selected="false" style="color: blue;">
                           <i class="fa fa-file-contract"></i> Giá trị thực hiện hợp đồng
                      </a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="ct2-tab" data-bs-toggle="tab" href="#ct2" role="tab" aria-controls="ct2" aria-selected="false" style="color: blue;">
                         <i class="fa fa-hand-holding-usd"></i> Giá trị tạm ứng
                      </a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="ct3-tab" data-bs-toggle="tab" href="#ct3" role="tab" aria-controls="ct3" aria-selected="false" style="color: blue;">
                          <i class="fa fa-shield-alt"></i> Giá trị bảo hành
                      </a>
                  </li>
                 <li class="nav-item" role="presentation">
                      <a class="nav-link" id="ct4-tab" data-bs-toggle="tab" href="#ct4" role="tab" aria-controls="ct4" aria-selected="false" style="color: blue;">
                         <i class="fa fa-money-check-alt"></i> Giá trị thanh toán
                      </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="labor-tab" data-bs-toggle="tab" href="#labor" role="tab" aria-controls="labor" aria-selected="false" style="color: blue;">
                        <i class="fa fa-users-cog"></i> Nhân công thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="ct6-tab" data-bs-toggle="tab" href="#ct6" role="tab" aria-controls="ct6" aria-selected="false" style="color: blue;">
                        <i class="fa fa-boxes"></i> Vật tư thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="ct7-tab" data-bs-toggle="tab" href="#ct7" role="tab" aria-controls="ct7" aria-selected="false" style="color: blue;">
                        <i class="fa fa-people-carry"></i> Thầu phụ thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="ct8-tab" data-bs-toggle="tab" href="#ct8" role="tab" aria-controls="ct8" aria-selected="false" style="color: blue;">
                        <i class="fa fa-industry"></i> Ca máy thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="ct9-tab" data-bs-toggle="tab" href="#ct9" role="tab" aria-controls="ct9" aria-selected="false" style="color: blue;">
                        <i class="fa fa-coins"></i> Chi phí khác đã thanh toán
                     </a>
                 </li>
            </ul>

			</div>
                   <div class="card-body">
                      <div class="skill-tags">
                      
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
                             <div class="tab-pane fade" id="ct6" role="tabpanel" aria-labelledby="ct6-tab">
                                    <!-- Vật tư thanh toán -->
                                    <?= $this->render('vat_tu_thanh_toan', ['model' => $model]) ?>
                             </div>
                             <div class="tab-pane fade" id="ct7" role="tabpanel" aria-labelledby="ct7-tab">
                                    <!-- Thầu phụ thanh toán -->
                                    <?= $this->render('thau_phu_thanh_toan', ['model' => $model]) ?>
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

        </div>

</div>


<style>
    .nav-tabs {
    overflow-x: auto;
    white-space: nowrap;
    flex-wrap: nowrap;
}
.nav-tabs .nav-item {
    float: none;
    display: inline-block;
}
</style>


