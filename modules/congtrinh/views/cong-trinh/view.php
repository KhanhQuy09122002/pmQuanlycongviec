<?php
$this->registerCssFile('@web/css/cong-trinh.css', [
    'depends' => [\yii\bootstrap5\BootstrapAsset::className()],
]);
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
                    <a class="nav-link active" id="ct0-tab" data-bs-toggle="pill" href="#ct0" role="tab" aria-controls="ct0" aria-selected="true">
                        <i class="fa fa-file-invoice-dollar"></i> Giá trị hợp đồng
                    </a>
                    <a class="nav-link" id="ct1-tab" data-bs-toggle="pill" href="#ct1" role="tab" aria-controls="ct1" aria-selected="true">
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
	<div style="color: #5D5FEF; font-weight: bold;text-transform: uppercase;font-size:18px;margin:10px 0px">
		<strong><?= $model->ten_cong_trinh ?></strong>
	</div>
    <div class="card custom-card">
        <div class="card-header custom-card-header rounded-bottom-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ct0" role="tabpanel" aria-labelledby="ct0-tab">
                    <!-- Giá trị hợp đồng -->
                    <?= $this->render('gia_tri_hop_dong', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct1" role="tabpanel" aria-labelledby="ct1-tab">
                    <!-- Giá trị thực hiện hợp đồng -->
                    <?= $this->render('../gia-tri-thuc-hien-hop-dong/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct2" role="tabpanel" aria-labelledby="ct2-tab">
                    <!-- Giá trị tạm ứng -->
                    <?= $this->render('../gia-tri-tam-ung/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct3" role="tabpanel" aria-labelledby="ct3-tab">
                    <!-- Giá trị bảo hành -->
                    <?= $this->render('../gia-tri-bao-hanh/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct4" role="tabpanel" aria-labelledby="ct4-tab">
                    <!-- Giá trị đã thanh toán -->
                    <?= $this->render('../gia-tri-da-thanh-toan/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct5" role="tabpanel" aria-labelledby="ct5-tab">
                    <!-- Nhân công thanh toán -->
                    <?= $this->render('../nhan-cong-thanh-toan/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct10" role="tabpanel" aria-labelledby="ct10-tab">
                    <!-- Nhân công thanh toán lịch sử -->
                    <?= $this->render('../nhan-cong-thanh-toan-ls/list', ['idCongTrinh' => $model->id]) ?>
                </div>
                <div class="tab-pane fade" id="ct6" role="tabpanel" aria-labelledby="ct6-tab">
                    <!-- Vật tư thanh toán -->
                    <?= $this->render('../vat-tu-thanh-toan/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct7" role="tabpanel" aria-labelledby="ct7-tab">
                    <!-- Thầu phụ thanh toán -->
                    <?= $this->render('../thau-phu-thanh-toan/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct11" role="tabpanel" aria-labelledby="ct11-tab">
                    <!-- Thầu phụ thanh toán lịch sử -->
                    <?= $this->render('../thau-phu-thanh-toan-ls/list', ['idCongTrinh' => $model->id]) ?>
                </div>
                <div class="tab-pane fade" id="ct8" role="tabpanel" aria-labelledby="ct8-tab">
                    <!-- Ca máy thanh toán -->
                    <?= $this->render('../ca-may-thanh-toan/list', ['model' => $model]) ?>
                </div>
                <div class="tab-pane fade" id="ct9" role="tabpanel" aria-labelledby="ct9-tab">
                    <!-- Chi phí khác thanh toán -->
                    <?= $this->render('../chi-phi-khac-thanh-toan/list', ['model' => $model]) ?>
                </div>
              
            </div>
        </div>
    </div>
</div>

</div>

</div>

<!-- print component -->
<div style="display:none">
    <div id="print">
    </div>
</div>

<script>
function InCT(type){
	$.ajax({
        type: 'post',
        url: '/congtrinh/cong-trinh/print-chi-tiet?idct=' + <?= $model->id?$model->id:"''" ?> + '&type=' + type,
        //data: frm.serialize(),
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);            
            if(data.status == 'success'){
            	$('#print').html(data.content);
            	printPhieu();//call from script.js
            } else {
            	alert('Lỗi!');
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });	
}
function InCT2(type,id){
	$.ajax({
        type: 'post',
        url: '/congtrinh/cong-trinh/print-chi-tiet2?type=' + type + '&id=' + id,
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);            
            if(data.status == 'success'){
            	$('#print').html(data.content);
            	printPhieu();//call from script.js
            } else {
            	alert('Lỗi!');
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });	
}
</script>

