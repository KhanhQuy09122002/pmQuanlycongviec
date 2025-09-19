<?php
use yii\helpers\Html;
use app\custom\CustomFunc;
?>

<div id="gthdContent">
    <div class="row">
        
        <div class="col-md-12">
        	<p style="margin-top:10px"><strong>Địa điểm công trình:</strong> <?= $model->dia_diem ?>
        	</p>
        	<p><strong>Thời hạn hợp đồng:</strong> từ ngày <?= CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_tu_ngay) ?> 
        		đến ngày <?= CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_den_ngay) ?>
        	<p><strong>Trạng thái:</strong> <?= $model->trang_thai ?></p>
        </div>
    </div>
    
    <div class="d-flex justify-content-between align-items-center fw-bold">
        <div>
            Giá trị hợp đồng: 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class="sTongTien">
                <?= number_format($model->gia_tri_hop_dong, 0, ',', '.') ?>
            </span>
        </div>
        <div class="ms-3"> 
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
    
    <div id="dThongKeSum" class="d-flex justify-content-between align-items-center fw-bold">
    <?= $this->render('thong_ke_sum', ['model'=>$model]) ?>  
	</div>
    
</div>


