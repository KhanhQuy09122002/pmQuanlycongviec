<?php
use yii\helpers\Html;
use app\custom\CustomFunc;

/** @var \app\models\CongTrinh $model */
?>

<h2 style="color: red; font-weight: bold;">Chi tiết công trình</h2>


<div class="thong-tin">
  
    <div style="text-align: center;  font-size: 16px;">
        <p><strong>Tên công trình:</strong> <?= Html::encode($model->ten_cong_trinh) ?></p>
        <p><strong>Địa điểm:</strong> <?= Html::encode($model->dia_diem) ?></p>
        <p><strong>Thời hạn hợp đồng:</strong>
            <?= CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_tu_ngay) ?>
            - <?= CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_den_ngay) ?>
        </p>
        <p><strong>Giá trị hợp đồng:</strong> <?= Yii::$app->formatter->asDecimal($model->gia_tri_hop_dong, 0) ?> VNĐ</p>
    </div>
</div>

<div style="text-align: center;">
        <hr style="width: 50%; border: 1px solid #000; margin: 20px auto;">
</div>


<?php if (!empty($model->giaTriThucHienHopDong)): ?>
    <?php
       /*  $tongGiaTriThucHien = 0;
        foreach ($model->giaTriThucHienHopDong as $item) {
            $tongGiaTriThucHien += $item->so_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">GIÁ TRỊ THỰC HIỆN HỢP ĐỒNG</div>
        <table>
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th>Ngày</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->giaTriThucHienHopDong as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td style="text-align: center"><?= CustomFunc::convertYMDToDMY($item->ngay_thang_bao_lanh) ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->so_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongGiaTriThucHienHopDong, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>


<?php if (!empty($model->giaTriTamUng)): ?>
    <?php
       /* $tongTamUng = 0;
        foreach ($model->giaTriTamUng as $item) {
            $tongTamUng += $item->so_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">GIÁ TRỊ TẠM ỨNG</div>
        <table>
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th>Ngày</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->giaTriTamUng as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td style="text-align: center"><?= CustomFunc::convertYMDToDMY($item->ngay_thang_bao_lanh) ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->so_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongGiaTriTamUng, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>



<?php if (!empty($model->giaTriBaoHanh)): ?>
    <?php
        /* $tongBaoHanh = 0;
        foreach ($model->giaTriBaoHanh as $item) {
            $tongBaoHanh += $item->so_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">GIÁ TRỊ BẢO HÀNH</div>
        <table>
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th>Ngày</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->giaTriBaoHanh as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td style="text-align: center"><?= CustomFunc::convertYMDToDMY($item->ngay_thang_bao_hanh) ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->so_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongGiaTriBaoHanh, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>




<?php if (!empty($model->giaTriDaThanhToan)): ?>
    <?php
        /* $tongGiaTriThanhToan = 0;
        foreach ($model->giaTriDaThanhToan as $item) {
            $tongGiaTriThanhToan += $item->so_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">GIÁ TRỊ ĐÃ THANH TOÁN</div>
        <table>
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th>Lần thanh toán</th>
                    <th>Ngày</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->giaTriDaThanhToan as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td style="text-align: center"><?= $item->ten_lan_thanh_toan ?></td>
                        <td style="text-align: center"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->so_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongGiaTriDaThanhToan, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>


<?php if (!empty($model->vatTuThanhToan)): ?>
    <?php
        /* $tongVatTu = 0;
        foreach ($model->vatTuThanhToan as $item) {
            $tongVatTu += $item->thanh_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">VẬT TƯ THANH TOÁN</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên vật tư</th>
                    <td>ĐVT</td>
                    <td>Ngày</td>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->vatTuThanhToan as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td><?= Html::encode($item->tenVatTu) ?></td>
                        <td style="text-align: center;"><?= $item->donViTinh  ?></td>
                        <td><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?></td>
                        <td style="text-align: center;"><?= $item->so_luong ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->don_gia, 0, ',', '.') ?>
                        </td>
                        <td style="text-align: right">
                             <?= number_format($item->thanh_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongVatTuThanhToan, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>


<?php if (!empty($model->nhanCongThanhToan)): ?>
    <?php
        /* $tongNhanCong = 0;
        foreach ($model->nhanCongThanhToan as $item) {
            $tongNhanCong += $item->da_thanh_toan;
        } */
    ?>
    <div class="section">
        <div class="section-title">NHÂN CÔNG THANH TOÁN</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Họ và tên</th>
                    <th>Tổng hợp đồng</th>
                    <th>Đã thanh toán</th>
                    <th>Còn lại</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->nhanCongThanhToan as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td style="text-align: center"><?= Html::encode($item->ho_ten) ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->tong_hop_dong, 0, ',', '.') ?>
                        </td>
                        <td style="text-align: right">
                             <?= number_format($item->tongDaThanhToan, 0, ',', '.') ?>
                        </td>
                        <td style="text-align: right">
                             <?= number_format($item->tongChuaThanhToan, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                  	<td colspan="2" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                  	 <td style="text-align: right; font-weight: bold;">
                       <?= number_format($model->tongNhanCong, 0, ',', '.') ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                       <?= number_format($model->tongNhanCongDaThanhToan, 0, ',', '.') ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                       <?= number_format($model->tongNhanCongChuaThanhToan, 0, ',', '.') ?>
                    </td>
                    <td></td>
               </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>


<?php if (!empty($model->thauPhuThanhToan)): ?>
    <?php
        /* $tongThauPhu = 0;
        foreach ($model->thauPhuThanhToan as $item) {
            $tongThauPhu += $item->da_thanh_toan;
        } */
    ?>
    <div class="section">
        <div class="section-title">THẦU PHỤ THANH TOÁN</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên nhà thầu</th>
                    <th>Tên công việc</th>
                    <th>Tổng hợp đồng</th>
                    <th>Đã thanh toán</th>
                    <th>Còn lại</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->thauPhuThanhToan as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td><?= Html::encode($item->ten_thau_phu) ?></td>
                        <td><?= Html::encode($item->ten_cong_viec) ?></td>
                        <td style="text-align: right">
                             <?= number_format($item->tong_hop_dong, 0, ',', '.') ?>
                        </td>
                        <td style="text-align: right">
                             <?= number_format($item->tongDaThanhToan, 0, ',', '.') ?>
                        </td>
                        <td style="text-align: right">
                             <?= number_format($item->tongChuaThanhToan, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                  	<td colspan="3" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                       <?= number_format($model->tongThauPhu, 0, ',', '.') ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                       <?= number_format($model->tongThauPhuDaThanhToan, 0, ',', '.') ?>
                    </td>
                    <td style="text-align: right; font-weight: bold;">
                       <?= number_format($model->tongThauPhuChuaThanhToan, 0, ',', '.') ?>
                    </td>
                    <td></td>
               </tr>

            </tbody>
        </table>
    </div>
<?php endif; ?>



<?php if (!empty($model->caMayThanhToan)): ?>
    <?php
        /* $tongCaMay = 0;
        foreach ($model->caMayThanhToan as $item) {
            $tongCaMay += $item->so_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">CA MÁY THANH TOÁN</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Tên ca máy</th>
                    <th>Ngày</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->caMayThanhToan as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td><?= Html::encode($item->ten_ca_may) ?></td>
                        <td style="text-align: center"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?>
                        <td style="text-align: right">
                             <?= number_format($item->so_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongCaMayThanhToan, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>



<?php if (!empty($model->chiPhiKhacThanhToan)): ?>
    <?php
        /* $tongChiPhiKhac = 0;
        foreach ($model->chiPhiKhacThanhToan as $item) {
            $tongChiPhiKhac += $item->so_tien;
        } */
    ?>
    <div class="section">
        <div class="section-title">CHI PHÍ KHÁC THANH TOÁN</div>
        <table>
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Chi phí</th>
                    <th>Ngày</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->chiPhiKhacThanhToan as $index => $item): ?>
                    <tr>
                        <td style="text-align: center"><?= $index + 1 ?></td>
                        <td><?= Html::encode($item->ten_chi_phi) ?></td>
                        <td style="text-align: center"><?= CustomFunc::convertYMDToDMY($item->ngay_thanh_toan) ?>
                        <td style="text-align: right">
                             <?= number_format($item->so_tien, 0, ',', '.') ?>
                        </td>
                        <td><?= $item->ghi_chu ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                    <td style="text-align: right; font-weight: bold;">
                        <?= number_format($model->tongChiPhiKhac, 0, ',', '.') ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>



<div class="footer-note">
    Ngày in: <?= Yii::$app->formatter->asDate('now', 'php:d/m/Y') ?>
</div>

<style>
    body {
        font-family: "DejaVu Sans", Arial, sans-serif;
        color: #333;
        font-size: 14px;
        line-height: 1.6;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        text-transform: uppercase;
        font-size: 20px;
        letter-spacing: 1px;
    }

    .section {
        margin-bottom: 40px;
    }

    .section-title {
        background-color: #f7f9fc;
        font-weight: bold;
        padding: 10px 15px;
        margin-bottom: 15px;
        border-left: 5px solid #007bff;
        font-size: 16px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    table th,
    table td {
        padding: 8px 12px;
        border: 1px solid #ccc;
        vertical-align: top;
        text-align: left;
    }

    table th {
        background-color: #f0f0f0;
        font-weight: bold;
        text-align: center;
    }

    .info-table td.label {
        width: 25%;
        font-weight: bold;
        background-color: #f9f9f9;
    }

    .info-table td.value {
        width: 75%;
    }

    .footer-note {
        margin-top: 50px;
        text-align: right;
        font-style: italic;
    }
</style>