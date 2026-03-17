<?php
use yii\helpers\Html;
use app\custom\CustomFunc;
use app\modules\user\models\User;

$CPKTT = $model->chiPhiKhacThanhToan; 
$itemType = 'chiphikhac';
?>

<div class="cpktt" id="cpkttContent">
<div class="row">
	<div class="col-md-12">
    	<h5>CHI PHÍ KHÁC ĐÃ THANH TOÁN</h5>
    </div>
	<div class="col-md-6">
		 <?= Html::a('<i class="fa fa-plus"></i> Thêm mới', 
                ['/congtrinh/chi-phi-khac-thanh-toan/create', 'idCT' => $model->id], 
                [
                    'class' => 'btn btn-sm fw-bold btn-info',
                    'style' => 'color: white;',
                    'role' => 'modal-remote-2', 
                    'title' => 'Thêm'
                ]
            ) ?>
         <?= Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa dữ liệu',
                        ["/congtrinh/chi-phi-khac-thanh-toan/bulkdelete"],
                        [
                            'class'=>'btn btn-sm fw-bold btn-warning',
                            'role'=>'modal-remote-bulk-2',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'Xác nhận xóa?',
                            'data-confirm-message'=>'Bạn có chắc muốn xóa?',
                            'itemtype'=>$itemType
                        ]) ?>
         <div class="btn-group mt-2 mb-2">
			<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
				<i class="fa fa-print"></i> In - Xuất file <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li class="dropdown-plus-title">
					Chọn chức năng
					<b class="fa fa-angle-up" aria-hidden="true"></b>
				</li>
				<li><span onClick="InCT('chiphikhacthanhtoan')" class="sButton"><i class="fa fa-print"></i> In báo cáo (A4)</span></li>
				<!-- 
				<li class="divider"></li>
				<li><span onClick="ExcelCT('vattuthanhtoan')" class="sButton"><i class="fa fa-file-excel-o"></i> Xuất file excel</span></li>
				 -->
			</ul>
		</div>
	</div>
	<div class="col-md-6" style="text-align: right">
		<span class="sTongTien">Tổng: <?= number_format($model->tongChiPhiKhac, 0, ',', '.') ?> VND</span>
	</div>
</div>



<div class="table-responsive cpktt-table-wrap">
<table id="tblChiPhiKhac" class="table table-bordered table-hover table-striped w-100">
    <thead class="table-light">
        <tr>
        	<th><span id="s-all-<?= $itemType ?>" style="cursor:pointer" >All</span>
                		<span id="us-all-<?= $itemType ?>" style="cursor:pointer;display:none">xAll</span></th>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;">Tên chi phí</th>
            <th style="text-align: center;">Số tiền</th>
            <th style="text-align: center;">Ngày thanh toán</th>
            <th style="text-align: center;">Ghi chú</th>
            <th style="text-align: center;">Người tạo</th>
            <th style="text-align: center;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($CPKTT)): ?>
        <?php 
            foreach ($CPKTT as $index => $item): 
        ?>
            <tr>
            	<td><?= Html::checkbox('selection'.$itemType.'[]', false, ['class'=>'chk'.$itemType,'value'=>$item->id]) ?></td>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td><?= $item->ten_chi_phi ?></td>
                <td style="text-align: right;">
                    <?= number_format($item->so_tien, 0, ',', '.')?>
                </td>
                <td style="text-align: center;"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?></td>
                <td><?= $item->ghi_chu ?></td>
                <td style="text-align: center;"><?= User::getNguoiTaoName($item->nguoi_tao) ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i>', 
                        ['/congtrinh/chi-phi-khac-thanh-toan/update', 'id' => $item->id, 'idCT' => $model->id], 
                        [
                            'class' => 'btn btn-sm fw-bold btn-warning',
                            'style' => 'color: white;',
                            'role' => 'modal-remote-2', 
                            'title' => 'Sửa'
                        ]
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        
    <?php else: ?>
        
    <?php endif; ?>
</tbody>

</table>
</div>
</div>

<script>
$('#s-all-<?= $itemType ?>').on('click', function(){
	 $('.chk<?= $itemType ?>').not(":disabled").attr('checked','checked');
	 $(this).hide();
	$('#us-all-<?= $itemType ?>').show();
});
$('#us-all-<?= $itemType ?>').on('click', function(){
	 $('.chk<?= $itemType ?>').removeAttr('checked');
	 $(this).hide();
	$('#s-all-<?= $itemType ?>').show();
});

var table = new DataTable('#tblChiPhiKhac',{
	//paging: false,
    pageLength: 20,
    autoWidth: true,
    "language": {
        "sLengthMenu":    "Hiển thị _MENU_ dòng dữ liệu/trang",
        "sInfo":          "Hiển thị _START_ - _END_ của _TOTAL_ dữ liệu",
        "sSearch":        "<i class='fa-solid fa-magnifying-glass'></i>",
        "emptyTable": "Chưa có dữ liệu",
        "infoEmpty": ""
    }
});
</script>

