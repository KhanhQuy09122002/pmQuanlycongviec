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
						<h6 class="card-title mb-0 "style="color: red;">Thông tin cá nhân: </h6>
					</div>
			    </div>
							<div class="card-body">
									<div class="skill-tags">
                                    <p><strong></strong><br>
                                        <?= $model->hinh_anh 
                                           ? \yii\helpers\Html::img(Yii::getAlias('@web') . '/' . $model->hinh_anh, [
                                           'style' => 'width:200px; border-radius:8px; margin-top:5px'
                                            ]) 
                                            : '(Không có ảnh)' 
                                        ?>
                                    </p>

                                        <p><strong>Họ Tên:</strong> <?= $model->ho_ten ?></p>
                                        <p><strong>Số điện thoại:</strong> <?= $model->so_dien_thoai?></p>
                                        <p><strong>Số CCCD:</strong> <?= $model->so_cccd ?></p>
                                        <p><strong>Mức lương:</strong> <?= number_format($model->muc_luong, 0, ',', '.') ?> VNĐ</p>
                                        <p><strong>Trạng thái:</strong> <?= $model->trang_thai ?></p>
								    </div>
						    </div>
	</div>
</div>
        <div class="col-xl-9 col-md-12">
                           
		<div class="card custom-card">
            <div class="card-header custom-card-header rounded-bottom-0">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="add-detail-tab" data-bs-toggle="tab" href="#add-detail" role="tab" aria-controls="add-detail" aria-selected="false"style="color: blue;"><i class="fa fa-address-card"></i> Bảng lương </a>
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


