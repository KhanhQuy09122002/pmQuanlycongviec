<div class="row">
	<div class="col-md-12">
        Đã thực hiện hợp đồng: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="sTongTien">
            <?= number_format($model->tongGiaTriThucHienHopDong, 0, ',', '.') ?>
        </span>
	</div>
	<div class="col-md-12">
        Đã tạm ứng: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="sTongTien">
            <?= number_format($model->tongGiaTriTamUng, 0, ',', '.') ?>
        </span>
	</div>
    <div class="col-md-12">
        Đã bảo hành: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="sTongTien">
            <?= number_format($model->tongGiaTriBaoHanh, 0, ',', '.') ?>
        </span>
    </div>
    <div class="col-md-12">
    	***Nhân công, thầu phụ, vật tư, ca máy, chi phí khác...
    	<br/>
        Đã thanh toán: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="sTongTien">
            <?= number_format(($model->tongGiaTriDaThanhToan + $model->tongNhanCongDaThanhToan
                + $model->tongVatTuThanhToan + $model->tongThauPhuDaThanhToan
                + $model->tongCaMayThanhToan + $model->tongChiPhiKhac ), 0, ',', '.') ?>
        </span>
        
    </div>
    <div class="col-md-12">
        Chưa thanh toán: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="sTongTien">
            <?= number_format(($model->tongNhanCongChuaThanhToan
                +  $model->tongThauPhuChuaThanhToan ), 0, ',', '.') ?>
        </span>
    </div>
</div>