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
                      <a class="nav-link active" id="add-detail-tab" data-bs-toggle="tab" href="#add-detail" role="tab" aria-controls="add-detail" aria-selected="false" style="color: blue;">
                           <i class="fa fa-file-contract"></i> Giá trị thực hiện hợp đồng
                      </a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="advance-tab" data-bs-toggle="tab" href="#advance" role="tab" aria-controls="advance" aria-selected="false" style="color: blue;">
                         <i class="fa fa-hand-holding-usd"></i> Giá trị tạm ứng
                      </a>
                  </li>
                  <li class="nav-item" role="presentation">
                      <a class="nav-link" id="warranty-tab" data-bs-toggle="tab" href="#warranty" role="tab" aria-controls="warranty" aria-selected="false" style="color: blue;">
                          <i class="fa fa-shield-alt"></i> Giá trị bảo hành
                      </a>
                  </li>
                 <li class="nav-item" role="presentation">
                      <a class="nav-link" id="payment-tab" data-bs-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false" style="color: blue;">
                         <i class="fa fa-money-check-alt"></i> Giá trị thanh toán
                      </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="labor-tab" data-bs-toggle="tab" href="#labor" role="tab" aria-controls="labor" aria-selected="false" style="color: blue;">
                        <i class="fa fa-users-cog"></i> Nhân công thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="materials-tab" data-bs-toggle="tab" href="#materials" role="tab" aria-controls="materials" aria-selected="false" style="color: blue;">
                        <i class="fa fa-boxes"></i> Vật tư thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="subcontractor-tab" data-bs-toggle="tab" href="#subcontractor" role="tab" aria-controls="subcontractor" aria-selected="false" style="color: blue;">
                        <i class="fa fa-people-carry"></i> Thầu phụ thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="machinery-tab" data-bs-toggle="tab" href="#machinery" role="tab" aria-controls="machinery" aria-selected="false" style="color: blue;">
                        <i class="fa fa-industry"></i> Ca máy thanh toán
                     </a>
                 </li>
                 <li class="nav-item" role="presentation">
                     <a class="nav-link" id="other-costs-tab" data-bs-toggle="tab" href="#other-costs" role="tab" aria-controls="other-costs" aria-selected="false" style="color: blue;">
                        <i class="fa fa-coins"></i> Chi phí khác đã thanh toán
                     </a>
                 </li>
            </ul>

			</div>
                   <div class="card-body">
                      <div class="skill-tags">
                      
                        <div class="tab-content" id="myTabContent">
                          
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


