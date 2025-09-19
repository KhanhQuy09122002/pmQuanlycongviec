<?php
use yii\helpers\Html;
use app\modules\congtrinh\models\ThauPhuThanhToan;
use app\modules\congtrinh\models\ThauPhuThanhToanLs;
use app\custom\CustomFunc;
use app\modules\congtrinh\models\CongTrinh;
use app\modules\user\models\User;

$itemType = 'thauphuct';
$congTrinh = CongTrinh::findOne($idCongTrinh);
// Lấy danh sách NhanCongThanhToan theo công trình
$dsTPTT = ThauPhuThanhToan::find()
    ->where(['id_cong_trinh' => $idCongTrinh])
    ->all();

$ids = array_column($dsTPTT, 'id');

// Tránh lỗi nếu $ids rỗng
$TPTTLS = [];
if (!empty($ids)) {
    $TPTTLS = ThauPhuThanhToanLs::find()
        ->where(['in', 'id_thau_phu_thanh_toan', $ids])
        ->all();
}
?>

<div class="tpttls" id="tpttlsContent">
    <div class="row">
    	<div class="col-md-12">
        	<h5>THẦU PHỤ THANH TOÁN CHI TIẾT</h5>
        </div>
    	<div class="col-md-6">
    		 <?= Html::a('<i class="fa fa-plus"></i> Thêm mới', 
    		     ['/congtrinh/thau-phu-thanh-toan-ls/create', 'idCongTrinh' => $idCongTrinh], 
                    [
                        'class' => 'btn btn-sm fw-bold btn-info',
                        'style' => 'color: white;',
                        'role' => 'modal-remote-2', 
                        'title' => 'Thêm'
                    ]
                ) ?>
             <?= Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa dữ liệu',
                            ["/congtrinh/thau-phu-thanh-toan-ls/bulkdelete"],
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
    		<span class="sTongTien">Tổng: <?= number_format($congTrinh->tongThauPhuDaThanhToan, 0, ',', '.') ?> VND</span>
    	</div>
    </div>

    <table id="tblThauPhuThanhToanLs" class="table table-bordered table-hover table-striped">
        <thead class="table-light">
            <tr>
            	<th style="width:3%"><span id="s-all-<?= $itemType ?>" style="cursor:pointer" >All</span>
                		<span id="us-all-<?= $itemType ?>" style="cursor:pointer;display:none">xAll</span></th>
                <th style="width: 30px;text-align: center;">STT</th>
                <th style="width: 200px;text-align: center;">Tên công việc</th>
                <th style="width: 200px;text-align: center;">Tên nhà thầu</th>
                <th style="width: 100px;text-align: center;">Ngày thanh toán</th>
                <th style="width: 100px;text-align: center;">Số tiền</th>
                <th style="width: 200px;text-align: center;">Ghi chú</th>
                <th style="width: 80px;text-align: center;">Người tạo</th>
                <th style="width: 100px;text-align: center;"></th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($TPTTLS)): ?>
        <?php 
            foreach ($TPTTLS as $index => $item): 
        ?>
            <tr>
            	<td><?= Html::checkbox('selection'.$itemType.'[]', false, ['class'=>'chk'.$itemType,'value'=>$item->id]) ?></td>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= $item->thauPhuThanhToan ? $item->thauPhuThanhToan->ten_cong_viec : '' ?></td>
                <td style="text-align: center;"><?= $item->thauPhuThanhToan ? $item->thauPhuThanhToan->ten_thau_phu : '' ?></td>
                <td style="text-align: center;"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?></td>
                <td style="text-align: center;">
                    <?= number_format($item->so_tien, 0, ',', '.') ?>
                </td>
                <td style="text-align: center;"><?= $item->ghi_chu ?></td>
                <td style="text-align: center;"><?= User::getNguoiTaoName($item->nguoi_tao) ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i>', 
                        ['/congtrinh/thau-phu-thanh-toan-ls/update', 'id' => $item->id, 'idCongTrinh' => $idCongTrinh], 
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

var table = new DataTable('#tblThauPhuThanhToanLs',{
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
