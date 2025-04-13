<?php
use yii\helpers\Html;
?>

<div class="gtthhd" id="gtthhdContent">
<div class="mb-3">
    <?= Html::a('<i class="fa fa-plus"></i> Thêm ', 
        ['/congtrinh/gia-tri-thuc-hien-hop-dong/create', 'idCT' => $modelCT->id], 
        [
            'class' => 'btn fw-bold btn-warning',
            'style' => 'color: white;',
            'role' => 'modal-remote-2', 
            'title' => 'Thêm'
        ]
    ) ?>
</div>


<table class="table table-bordered table-hover table-striped">
    <thead class="table-light">
        <tr>
            <th style="width: 40px;">#</th>
            <th style="width: 100px;">Số tiền</th>
            <th style="width: 100px;">Ngày tháng bảo lãnh</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($GTTHHD)): ?>
            <?php foreach ($GTTHHD as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td style="text-align: left;"><?= number_format($item->so_tien, 0, ',', '.') . ' VNĐ' ?> </td>
                    <td><?= date('d/m/Y', strtotime($item->ngay_thang_bao_lanh)) ?></td>
                    <td>
                    
                         <?= Html::a('<i class="fa fa-edit"></i> Sửa', 
                           ['/nhacungcap/cong-no-nha-cung-cap/update', 'id' => $item->id, 'idCT'=>$modelCT->id], 
                               [
                                  'class' => 'btn fw-bold btn-warning',
                                  'style' => 'color: white;',
                                  'role' => 'modal-remote-2', 
                                  'title' => 'Sửa'
                               ]
                         ) ?>
        
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center text-muted">Không có dữ liệu.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

