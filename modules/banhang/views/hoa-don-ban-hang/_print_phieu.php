<?php
use yii\helpers\Html;
use app\custom\CustomFunc;
use app\modules\user\models\User;
$custom = new CustomFunc();
?>
<!-- <link href="/css/print-hoa-don.css" rel="stylesheet"> -->
<div class="row text-center" style="width: 100%">
    <div class="col-md-12" style="width: 100%"> 
    	<table id="table-top" style="width: 100%">
    		<tr>
    			<td>
    				<img src="/images/logo.png" width="75px" />
    			</td>
    			<td>
    				<span style="font-weight: bold; font-size:10pt">CÔNG TY TNHH VẬT LIỆU XÂY DỰNG BA VŨ</span>
    				<br/>
    				<span style="font-size:8pt">ĐC: Số 222, Đường Sơn Thông, Khóm 1, Phường Nguyệt Hóa, Tỉnh Vĩnh Long</span>
    				<br/>
    				<span style="font-size:8pt">ĐT: 0939951717 - 029422343</span>
    				
    			</td>
    			<td>
    				<div><span style="font-size:8pt">Số HĐ: <?= $model->soHoaDon ?></span></div>
    				<div><span style="font-size:8pt">Ngày xuất: <?= CustomFunc::convertYMDToDMY($model->ngay_xuat) ?></span></div>
    				<div style="margin-top: 5px;">
    					<span class="span-status" style="font-size:8pt"><?= $model->getDmTrangThaiLabel($model->trang_thai) ?></span> 					</div>
    			</td>
    		</tr>
    	</table>
    	
    	<table style="width: 100%; margin-top:5px;">
    		<tr>
    			<td style="text-align: center"><span style="font-size:22pt;font-weight:bold">HÓA ĐƠN BÁN HÀNG</span></td>
    		</tr>
    	</table>
    	
    	<table id="table-info" style="width: 100%; margin-top:0px;">
    		<tr>
    			<td>
    				Khách hàng: <?= $model->khachHang?$model->khachHang->ho_ten:'' ?>			
    			</td>
    			<td align="right">
    				SĐT: <?= $model->khachHang?$model->khachHang->so_dien_thoai:'' ?>	
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2">
    				Địa chỉ: <?= $model->khachHang?$model->khachHang->dia_chi:'' ?>	
    			</td>
    			<!-- <td>
    				Email: <?= $model->khachHang?$model->khachHang->email:'' ?>
    			</td>-->
    		</tr>
    		
    	</table>
    	
    	<table id="table-content" style="width: 100%; margin-top:5px;">
    		<thead>
    			<tr style="font-weight:bold">
        			<td style="width:3%">Số TT</td>
        			<td style="width:12%">Mã số</td>
        			<td style="width:30%">Tên hàng</td>        			
        			<td style="width:10%">ĐVT</td>
        			<td style="width:10%">Số lượng</td>
        			<td style="width:10%">Đơn giá<br/>(VND)</td>
        			<td style="width:10%">CK<br/>(VND)</td>
        			<td style="width:15%">Thành tiền<br/>(VND)</td>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
    			$stt = 0;
    			foreach ($model->hoaDonChiTiets as $iVT=>$vt){
    			    $stt++;
    			?>
    			<tr>
        			<td style="text-align:center"><?= $stt ?></td>
        			<td style="text-align:center"><?= $vt->hangHoa->ma_hang_hoa ?></td>
        			<td><?= $vt->hangHoa->ten_hang_hoa ?></td>        			
        			<td style="text-align:center"><?= $vt->hangHoa->donViTinh->ten_dvt ?></td>
        			<td style="text-align:right"><?= $vt->soLuong ?></td>
        			<td style="text-align:right"><?= number_format($vt->donGia) ?></td>
        			<td style="text-align:right"><?= number_format($vt->chietKhau) ?></td>
        			<td style="text-align:right;font-weight: bold"><?= number_format($vt->thanhTien) ?></td>
        			<!-- <td style="text-align:center"><?= $vt->ghi_chu ?></td>-->
    			</tr>
    			<?php 
    			}
    			?>
    			
    			<tr style="text-align:right;font-weight: bold">
        			<td colspan="7">Tổng cộng:</td>
        			<td><?= number_format($model->tongTien) ?></td>
    			</tr>
    			
    		</tbody>
    	</table>
    	
    	<p style="margin-top:6pt;"><span style="font-size:11pt;font-weight: bold;">Tổng số tiền bằng chữ:</span> <span style="font-style:italic;"><?= $custom->chuyenSoTienThanhChu($model->tongTien) ?> đồng.</span></p>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:5px;">
    		<tr>
    			<td style="text-align:right;font-weight:normal;font-style:italic;font-size:11pt">Vĩnh Long, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?></td>
    		</tr>
    	</table>
    	
    	<table id="table-ky-ten" style="width: 100%; margin-top:5px;">
    		<tr>
    			<td style="font-size: 10pt">NGƯỜI NỘP TIỀN</td>
    			<td></td>
    			<td style="font-size: 10pt">NGƯỜI THU TIỀN</td>
    		</tr>
    		<!-- <tr>
    			<td><span style="font-size: 8pt">(Ký, Họ tên)</span></td>
    			<td></td>
    			<td><span style="font-size: 8pt">(Ký, Họ tên)</span></td>
    		</tr> -->
    		<tr>
        		<td></td>
        		<td></td>
    			<td style="padding-top:35px;font-size:10pt"><?= User::getHoTenByID($model->nguoi_tao) ?></td>
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