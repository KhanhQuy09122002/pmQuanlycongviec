<h3 style="text-align: center;">BẢNG LƯƠNG NHÂN VIÊN</h3>
<p><strong>Họ tên:</strong> <?= $nhanVien->ho_ten ?></p>

<table>
    <thead>
        <tr>
            <th>Ngày</th>
            <th>Số tiền</th>
            <th>Ghi chú</th>
            <th>Đã nhận</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dsLuong as $dong): ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($dong->ngay_thang)) ?></td>
                <td><?= number_format($dong->so_tien, 0, ',', '.') ?> VND</td>
                <td><?= $dong->ghi_chu ?></td>
                <td>
                   <?= $dong->da_nhan 
                      ? '<i class="fas fa-check-circle" style="color: green;"></i>'  // Biểu tượng check
                      : '<i class="fas fa-times-circle" style="color: red;"></i>'  // Biểu tượng x
                   ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
