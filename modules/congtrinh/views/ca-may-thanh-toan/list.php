<?php
use yii\helpers\Html;
use app\custom\CustomFunc;
use app\modules\user\models\User;

$CMTT = $model->caMayThanhToan;
$itemType = 'camay';
?>

<div class="cmtt" id="cmttContent">

<div class="row">
	<div class="col-md-12">
    	<h5>CA MÃY THANH TOÃN</h5>
    </div>
	<div class="col-md-6">
		 <?= Html::a('<i class="fa fa-plus"></i> ThÃªm má»›i', 
                ['/congtrinh/ca-may-thanh-toan/create', 'idCT' => $model->id], 
                [
                    'class' => 'btn btn-sm fw-bold btn-info',
                    'style' => 'color: white;',
                    'role' => 'modal-remote-2', 
                    'title' => 'ThÃªm'
                ]
            ) ?>
         <?= Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; XÃ³a dá»¯ liá»‡u',
                        ["/congtrinh/ca-may-thanh-toan/bulkdelete"],
                        [
                            'class'=>'btn btn-sm fw-bold btn-warning',
                            'role'=>'modal-remote-bulk-2',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'XÃ¡c nháº­n xÃ³a?',
                            'data-confirm-message'=>'Báº¡n cÃ³ cháº¯c muá»‘n xÃ³a?',
                            'itemtype'=>$itemType
                        ]) ?>
          <div class="btn-group mt-2 mb-2">
			<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
				<i class="fa fa-print"></i> In - Xuáº¥t file <span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li class="dropdown-plus-title">
					Chá»n chá»©c nÄƒng
					<b class="fa fa-angle-up" aria-hidden="true"></b>
				</li>
				<li><span onClick="InCT('camaythanhtoan')" class="sButton"><i class="fa fa-print"></i> In bÃ¡o cÃ¡o (A4)</span></li>
				<!-- 
				<li class="divider"></li>
				<li><span onClick="ExcelCT('vattuthanhtoan')" class="sButton"><i class="fa fa-file-excel-o"></i> Xuáº¥t file excel</span></li>
				 -->
			</ul>
		</div>
	</div>
	<div class="col-md-6" style="text-align: right">
		<span class="sTongTien">Tá»•ng: <?= number_format($model->tongCaMayThanhToan, 0, ',', '.') ?> VND</span>
	</div>
</div>

<div class="table-responsive cmtt-table-wrap">
<table id="tblCaMay" class="table table-bordered table-hover table-striped w-100">
    <thead class="table-light">
        <tr>
        	<th><span id="s-all-<?= $itemType ?>" style="cursor:pointer" >All</span>
                		<span id="us-all-<?= $itemType ?>" style="cursor:pointer;display:none">xAll</span></th>
            <th style="text-align: center;">STT</th>
            <th style="text-align: center;">TÃªn ca mÃ¡y</th>
            <th style="text-align: center;">Sá»‘ tiá»n (VNÄ)</th>
            <th style="text-align: center;">NgÃ y thanh toÃ¡n</th>
            <th style="text-align: center;">Ghi chÃº</th>
            <th style="text-align: center;">NgÆ°á»i táº¡o</th>
            <th style="text-align: center;"></th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($CMTT)): ?>
        <?php 
            foreach ($CMTT as $index => $item): 
        ?>
            <tr>
            	<td><?= Html::checkbox('selection'.$itemType.'[]', false, ['class'=>'chk'.$itemType,'value'=>$item->id]) ?></td>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td><?= $item->ten_ca_may ?></td>
                <td style="text-align: right;">
                    <?= number_format($item->so_tien, 0, ',', '.') ?>
                </td>
                <td style="text-align: center;"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?></td>
                <td>
                	<?= $item->ghi_chu ?>
                </td>
                <td style="text-align: center;"><?= User::getNguoiTaoName($item->nguoi_tao) ?></td>
                <td style="text-align: center;">
                    <?= Html::a('<i class="fa fa-edit"></i>', 
                        ['/congtrinh/ca-may-thanh-toan/update', 'id' => $item->id, 'idCT' => $model->id], 
                        [
                            'class' => 'btn btn-sm fw-bold btn-warning',
                            'style' => 'color: white;',
                            'role' => 'modal-remote-2', 
                            'title' => 'Sá»­a'
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

var table = new DataTable('#tblCaMay',{
	//paging: false,
    pageLength: 20,
    autoWidth: true,
    "language": {
        "sLengthMenu":    "Hiá»ƒn thá»‹ _MENU_ dÃ²ng dá»¯ liá»‡u/trang",
        "sInfo":          "Hiá»ƒn thá»‹ _START_ - _END_ cá»§a _TOTAL_ dá»¯ liá»‡u",
        "sSearch":        "<i class='fa-solid fa-magnifying-glass'></i>",
        "emptyTable": "ChÆ°a cÃ³ dá»¯ liá»‡u",
        "infoEmpty": ""
    }
});
	table.columns.adjust().draw(false);
</script>

