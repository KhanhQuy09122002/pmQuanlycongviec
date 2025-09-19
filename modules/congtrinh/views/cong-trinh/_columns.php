<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\custom\CustomFunc;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header'=>'',
        //'template' => '{view} {ghimIndex} {cancelIndex} {ghimMenu} {cancelMenu} {in} {excel} {update} {delete}',
        'template' => '{view} {ghimIndex} {cancelIndex} {ghimMenu} {cancelMenu} {in} {update} {delete}',
        'dropdown' => true,
        'dropdownOptions' => ['class' => 'float-right'],
        'dropdownButton'=>[
            'label'=>'<i class="fe fe-settings floating"></i>',
            'class'=>'btn dropdown-toggle p-0'
        ],
        'vAlign'=>'middle',
        'width' => '20px',
        'urlCreator' => function($action, $model, $key, $index) {
            if ($action === 'ghimIndex') {
                return Url::to(['ghim', 'idct' => $key, 'type'=>'index']);
            }
            if ($action === 'cancelIndex') {
                return Url::to(['cancel-ghim', 'idct' => $key, 'type'=>'index']);
            }
            if ($action === 'ghimMenu') {
                return Url::to(['ghim', 'idct' => $key, 'type'=>'menu']);
            }
            if ($action === 'cancelMenu') {
                return Url::to(['cancel-ghim', 'idct' => $key, 'type'=>'menu']);
            }
            if ($action === 'in') {
                return Url::to(['#']);
            }
            if ($action === 'excel') {
                return Url::to(['export-excel', 'id' => $key]);
            }
            return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'ghimIndex' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-star-o"></i> Ghim bắt đầu', $url, [
                    'title' => 'Ghim bắt đầu',
                    'role' => 'modal-remote-2',
                    'class' => 'btn ripple btn-warning dropdown-item',
                    'data-bs-placement' => 'top',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-dismiss' => 'modal'
                ]);
            },
            'cancelIndex' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-star"></i> Hủy ghim bắt đầu', $url, [
                    'title' => 'Hủy ghim bắt đầu',
                    'role' => 'modal-remote-2',
                    'class' => 'btn ripple btn-warning dropdown-item  text-primary',
                    'data-bs-placement' => 'top',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-dismiss' => 'modal'
                ]);
            },
            'ghimMenu' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-tags"></i> Ghim menu', $url, [
                    'title' => 'Ghim menu',
                    'role' => 'modal-remote-2',
                    'class' => 'btn ripple btn-warning dropdown-item',
                    'data-bs-placement' => 'top',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-dismiss' => 'modal'
                ]);
            },
            'cancelMenu' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-tags"></i> Hủy ghim menu', $url, [
                    'title' => 'Hủy ghim menu',
                    'role' => 'modal-remote-2',
                    'class' => 'btn ripple btn-warning dropdown-item text-primary',
                    'data-bs-placement' => 'top',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-dismiss' => 'modal'
                ]);
            },
            'view' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-info-circle"></i> Xem thông tin', $url, [
                    'title' => 'Xem thông tin',
                    'role'=>'modal-remote',
                    'class'=>'btn ripple btn-primary dropdown-item',
                    'data-bs-placement'=>'top',
                    'data-bs-toggle'=>'tooltip-primary'
                ]);
            },
            'in' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-print"></i> In thông tin', $url, [
                    'title' => 'In thông tin',
                    'onclick' => 'inChiTietCongTrinh2('.$model->id.')',
                    //'role'=>'modal-remote',
                    'class'=>'btn ripple btn-primary dropdown-item',
                    //'data-bs-placement'=>'top',
                    //'data-bs-toggle'=>'tooltip-primary'
                ]);
            },
            'excel' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-file-excel-o"></i> Xuất excel', $url, [
                    'title' => 'Xuất excel',
                    'target' => '_blank',
                    'data-pjax'=>0,
                    'class'=>'btn ripple btn-primary dropdown-item',
                    //'data-bs-placement'=>'top',
                    //'data-bs-toggle'=>'tooltip-primary'
                ]);
            },
        ],
        'visibleButtons' => [
            'ghimIndex' => function ($model, $key, $index) {
                return !$model->ghim_index;
            },
            'cancelIndex' => function ($model, $key, $index) {
                return $model->ghim_index;
            },
            'ghimMenu' => function ($model, $key, $index) {
                return !$model->ghim_menu;
            },
            'cancelMenu' => function ($model, $key, $index) {
                return $model->ghim_menu;
            },
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'Chi tiết',
               'class'=>'btn ripple btn-primary btn-sm',
              'data-bs-placement'=>'top',
              'data-bs-toggle'=>'tooltip-primary'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Sửa', 
            'class'=>'btn ripple btn-info btn-sm text-warning',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-info'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Xóa', 
                      'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                      'data-request-method'=>'post',
                      'data-toggle'=>'tooltip',
                      'data-confirm-title'=>'Xác nhận xóa dữ liệu?',
                      'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?',
                       'class'=>'btn ripple btn-warning btn-sm text-warning',
                       'data-bs-placement'=>'top',
                       'data-bs-toggle'=>'tooltip-secondary'], 

    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_cong_trinh',
        'value'=>function($model){
            return Html::a($model->ten_cong_trinh, ['/congtrinh/cong-trinh/view', 'id'=>$model->id], [
                'role'=>'modal-remote',
                'class'=>'btn-in-grid'
            ]);
        },
        //'width' => '200px',
        'format'=>'raw',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dia_diem',
    ],
  
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'thoi_han_hop_dong_tu_ngay',
        'value' => function ($model) {
            return CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_tu_ngay);
        },
        'label' => 'Từ ngày',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'thoi_han_hop_dong_den_ngay',
        'value' => function ($model) {
            return CustomFunc::convertYMDToDMY($model->thoi_han_hop_dong_den_ngay);
        },
        'label' => 'Đến ngày',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'trang_thai',
        'format' => 'raw',
        'value' => function ($model) {
            $colors = [
                'Sắp thi công' => 'warning',
                'Đang thi công' => 'primary',
                'Đã hoàn thành' => 'success',
            ];
            $colorClass = $colors[$model->trang_thai] ?? 'secondary';
            return '<span class="badge bg-' . $colorClass . '">' . $model->trang_thai . '</span>';
        },
        'filter' => [
            'Sắp thi công' => 'Sắp thi công',
            'Đang thi công' => 'Đang thi công',
            'Đã hoàn thành' => 'Đã hoàn thành',
        ],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghim_index',
        'label'=>'',
        'value'=>function($model){
            return $model->ghim_index ? '<i class="fa fa-star-o"></i>' : '';
        },
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghim_menu',
        'label'=>'',
        'value'=>function($model){
            return $model->ghim_menu ? '<i class="fa fa-tags"></i>' : '';
        },
        'format'=>'raw'
    ],
    
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gia_tri_tam_ung',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gia_tri_bao_lanh_thoi_han_hop_dong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gia_tri_bao_hanh',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gia_tri_da_thanh_toan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gia_tri_hop_dong_con_lai',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'khoi_luong_phat_sinh_tang_giam',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'trang_thai',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nguoi_tao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'thoi_gian_tao',
    // ],


];   