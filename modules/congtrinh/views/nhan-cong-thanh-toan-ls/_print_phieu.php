<?php
use yii\helpers\Html;
use app\custom\CustomFunc;
use app\modules\user\models\User;
$custom = new CustomFunc();
?>
<!-- <link href="/css/print-hoa-don.css" rel="stylesheet"> -->
<div class="row text-center" style="width: 100%">
    <div class="col-md-12" style="width: 100%"> 
    	<table style="width: 100%">
    		<tr>
    			<td style="width:100px">
    				<img src="/images/logo.png" width="75px" />
    			</td>
    			<td>
    				<span style="font-weight: bold; font-size:10pt">CÔNG TY TNHH VẬT LIỆU XÂY DỰNG BA VŨ</span>
    				<br/>
    				<span style="font-size:8pt">ĐC: Số 222, Đường Sơn Thông, Khóm 1, Phường Nguyệt Hóa, Tỉnh Vĩnh Long</span>
    				<br/>
    				<span style="font-size:8pt">ĐT: 0939951717 - 029422343</span>
    				
    			</td>
    		</tr>
    	</table>
    	
    	<table style="width: 100%; margin-top:5px;">
    		<tr>
    			<td style="text-align: center"><span style="font-size:14pt;font-weight:bold;text-transform: uppercase;">CÔNG TRÌNH: 
    				<?= $model->congTrinh->ten_cong_trinh ?></span></td>
    		</tr>
    		<tr>
    			<td style="text-align: center"><span style="font-size:14pt;font-weight:bold">BÁO CÁO CHI PHÍ NHÂN CÔNG THEO HỢP ĐỒNG</span></td>
    		</tr>
    	</table>
    	
    
    	<table style="width: 100%; margin-top:10px;">
    		<tr>
    			<td>
    				Họ tên: <?= $model->ho_ten ?>			
    			</td>
    			<td>
    				Số hợp đồng: <?= $model->so_hop_dong ?>	
    			</td>
    			<td>
    				Tổng hợp đồng: <?= number_format($model->tong_hop_dong, 0, ',', '.') ?> VND	
    			</td>
    		</tr>
    		
    	</table>

    	
    	<table id="table-content" style="width: 100%; margin-top:5px;">
    		<thead>
    			<tr style="font-weight:bold">
        			<td style="width:5%">Số TT</td>
        			<td style="width:15%">Số HĐ</td>
        			<td style="width:20%">Ngày thanh toán</td>   
        			<td style="width:20%">Số tiền</td>
        			<td style="width:20%">Nhân viên</td>        			
        			<td style="width:20%">Ghi chú</td>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
    			$stt = 0;
    			foreach ($model->ctNhanCongThanhToanLichSus as $iVT=>$item){
    			    $stt++;
    			?>
    			<tr>
        			<td style="text-align:center"><?= $stt ?></td>
        			<td style="text-align:left"><?= $item->nhanCongThanhToan->so_hop_dong ?></td>
        			<td style="text-align:center"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?></td>
        			<td style="text-align:right"><?= number_format($item->so_tien, 0, ',', '.') ?></td>
        			<td style="text-align:center"><?= User::getNguoiTaoName($item->nguoi_tao) ?></td>
        			<td style="text-align:left"><?= $item->ghi_chu ?></td>
    			</tr>
    			<?php 
    			}
    			?>
    			<tr style="text-align:right;font-weight: bold">
        			<td colspan="3">Tổng cộng:</td>
        			<td><?= number_format($model->tongDaThanhToan, 0, ',', '.') ?></td>
        			<td></td><td></td>
    			</tr>
    			<tr style="text-align:right;font-weight: bold">
        			<td colspan="3">Còn lại chưa thanh toán:</td>
        			<td><?= number_format($model->tongChuaThanhToan, 0, ',', '.') ?></td>
        			<td></td><td></td>
    			</tr>
    			
    		</tbody>
    	</table>
    	
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:5px;">
    		<tr>
    			<td style="text-align:right;font-weight:normal;font-style:italic;font-size:11pt">Vĩnh Long, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></td>
    		</tr>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:5px;">
    		<tr>
    			<td style="font-size: 10pt"></td>
    			<td></td>
    			<td style="font-size: 10pt">NGƯỜI LẬP</td>
    		</tr>
    		<!-- <tr>
    			<td><span style="font-size: 8pt">(Ký, Họ tên)</span></td>
    			<td></td>
    			<td><span style="font-size: 8pt">(Ký, Họ tên)</span></td>
    		</tr> -->
    		<tr>
        		<td></td>
        		<td></td>
    			<td style="padding-top:35px;font-size:10pt"><?= User::getHoTenByID(Yii::$app->user->id) ?></td>
    		</tr>
    	</table>
    	<!-- 
    	<table id="table-footer" style="width: 100%; margin-top:0px;">
    		<tr>
    			<td style="font-size: 8pt"><strong>*CHÚ Ý: VUI LÒNG GIỮ LẠI PHIẾU NÀY ĐỂ ĐỐI CHIẾU VỀ SAU</strong></td>
    			<td style="font-size: 8pt">Ngày in: <?= date('d/m/Y H:i') ?></td>
    		</tr>
    	</table>
    	 -->
    	
    	
    	
    	
    	   
    </div>
</div> <!-- row -->