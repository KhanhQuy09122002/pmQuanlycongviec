<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use app\custom\CustomFunc;
use app\modules\user\models\User;

$GTTHHD = $model->giaTriThucHienHopDong; 
$itemType = 'giatrithuchienhopdong';
?>

<div class="gtthhd" id="gtthhdContent">
<div class="row">
	<div class="col-md-12">
		<h5>GIÁ TRỊ THỰC HIỆN HỢP ĐỒNG</h5>
	</div>
	<div class="col-md-6">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/gia-tri-thuc-hien-hop-dong/create', 'idCT' => $model->id], 
        [
            'class' => 'btn btn-sm fw-bold btn-info',
            'style' => 'color: white;',
            'role' => 'modal-remote-2', 
            'title' => 'Thêm'
        ]
    ) ?>
    <?= Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa dữ liệu',
        ["/congtrinh/gia-tri-thuc-hien-hop-dong/bulkdelete"],
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
		<span class="sTongTien">Tổng: <?= number_format($model->tongGiaTriThucHienHopDong, 0, ',', '.') ?> VND</span>
	</div>
</div>


<table id="tblGiaTriThucHienHopDong" class="table table-bordered table-hover table-striped">
    <thead class="table-light">
        <tr>
        <th style="width:3%"><span id="s-all-<?= $itemType ?>" style="cursor:pointer" >All</span>
                		<span id="us-all-<?= $itemType ?>" style="cursor:pointer;display:none">xAll</span></th>
            <th style="width: 40px;text-align: center;">STT</th>
            <th style="width: 200px;text-align: center;">Số tiền</th>
            <th style="width: 200px;text-align: center;">Ngày</th>
            <th style="width: 300px;text-align: center;">Ghi chú</th>
            <th style="width: 100px;text-align: center;">Người tạo</th>
            <th style="width: 100px;text-align: center;"></th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($GTTHHD)): ?>
        <?php 
            foreach ($GTTHHD as $index => $item): 
        ?>
            <tr>
            	<td><?= Html::checkbox('selection'.$itemType.'[]', false, ['class'=>'chk'.$itemType,'value'=>$item->id]) ?></td>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: right;"><?= number_format($item->so_tien, 0, ',', '.') ?> </td>
                <td style="text-align: center;"><?= CustomFunc::convertYMDToDMY($item->ngay_thang_bao_lanh) ?></td>
                <td><?= $item->ghi_chu ?></td>
                <td style="text-align: center;"><?= User::getNguoiTaoName($item->nguoi_tao) ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i>', 
                        ['/congtrinh/gia-tri-thuc-hien-hop-dong/update', 'id' => $item->id, 'idCT'=>$model->id], 
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

var table = new DataTable('#tblGiaTriThucHienHopDong',{
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


