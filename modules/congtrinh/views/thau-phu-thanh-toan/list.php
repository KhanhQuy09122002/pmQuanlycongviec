<?php
use yii\helpers\Html;
use app\modules\user\models\User;

$TPTT = $model->thauPhuThanhToan; 
$itemType = 'thauphu';
?>

<div class="tptt" id="tpttContent">

<div class="row">
	<div class="col-md-12">
    	<h5>THẦU PHỤ THANH TOÁN</h5>
    </div>
	<div class="col-md-6">
		 <?= Html::a('<i class="fa fa-plus"></i> Thêm mới', 
                ['/congtrinh/thau-phu-thanh-toan/create', 'idCT' => $model->id], 
                [
                    'class' => 'btn btn-sm fw-bold btn-info',
                    'style' => 'color: white;',
                    'role' => 'modal-remote-2', 
                    'title' => 'Thêm'
                ]
            ) ?>
         <?= Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa dữ liệu',
                        ["/congtrinh/thau-phu-thanh-toan/bulkdelete"],
                        [
                            'class'=>'btn btn-sm fw-bold btn-warning',
                            'role'=>'modal-remote-bulk-2',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'Xác nhận xóa?',
                            'data-confirm-message'=>'Bạn có chắc muốn xóa?',
                            'itemtype'=>$itemType
                        ]) ?>
	</div>
	<div class="col-md-6" style="text-align: right">
		Tổng: <span class="sTongTien"><?= number_format($model->tongThauPhu, 0, ',', '.') ?> VND</span> 
		<br/>Đã thanh toán: <span class="sTongTien2"><?= number_format($model->tongThauPhuDaThanhToan, 0, ',', '.') ?> VND</span>
		<br/>Chưa thanh toán: <span class="sTongTien2"><?= number_format($model->tongThauPhuChuaThanhToan, 0, ',', '.') ?> VND</span>
	</div>
</div>


<table id="tblThauPhuThanhToan" class="table table-bordered table-hover table-striped table-responsive">
    <thead class="table-light">
        <tr>
        	<th style="width:3%"><span id="s-all-<?= $itemType ?>" style="cursor:pointer" >All</span>
                		<span id="us-all-<?= $itemType ?>" style="cursor:pointer;display:none">xAll</span></th>
            <th style="width: 30px;text-align: center;">STT</th>
            <th style="width: 200px;text-align: center;">Tên công việc</th>
            <th style="width: 200px;text-align: center;">Tên nhà thầu</th>
            <th style="width: 100px;text-align: center;">Số hợp đồng</th>
            <th style="width: 120px;text-align: center;">Tổng hợp đồng</th>
            <th style="width: 120px;text-align: center;">Đã thanh toán</th>
            <th style="width: 120px;text-align: center;">Còn lại</th>
            <th style="width: 100px;text-align: center;">Ghi chú</th>
            <th style="width: 80px;text-align: center;">Người tạo</th>
            <th style="width: 100px;text-align: center;"></th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($TPTT)): ?>
        <?php 
            foreach ($TPTT as $index => $item): 
        ?>
            <tr>
            	<td><?= Html::checkbox('selection'.$itemType.'[]', false, ['class'=>'chk'.$itemType,'value'=>$item->id]) ?></td>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td><?= $item->ten_cong_viec ?></td>
                <td><?= $item->ten_thau_phu ?></td>
                <td style="word-break:break-all;"><?= $item->so_hop_dong ?></td>
                <td style="text-align: right;"><?= number_format($item->tong_hop_dong, 0, ',', '.')?> </td>
                <td style="text-align: right;"><?= number_format($item->tongDaThanhToan, 0, ',', '.') ?> </td>
                <td style="text-align: right;"><?= number_format($item->tongChuaThanhToan, 0, ',', '.') ?> </td>
                <td>
                	<?= $item->ghi_chu ?>
                </td>
                <td style="text-align: center;"><?= User::getNguoiTaoName($item->nguoi_tao) ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i>', 
                        ['/congtrinh/thau-phu-thanh-toan/update', 'id' => $item->id, 'idCT' => $model->id], 
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

var table = new DataTable('#tblThauPhuThanhToan',{
	//paging: false,
    pageLength: 20,
    "language": {
        "sLengthMenu":    "Hiển thị _MENU_ dòng dữ liệu/trang",
        "sInfo":          "Hiển thị _START_ - _END_ của _TOTAL_ dữ liệu",
        "sSearch":        "<i class='fa-solid fa-magnifying-glass'></i>",
        "emptyTable": "Chưa có dữ liệu",
        "infoEmpty": ""
    }
});
</script>

