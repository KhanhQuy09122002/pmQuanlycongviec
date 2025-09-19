<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\vanban\models\search\VBDenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách công trình ';
$this->params['breadcrumbs'][] = $this->title;
//CrudAsset::register($this);
Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;
?>

<div class="card border-default" id="divFilterExtend">
	<div class="card-header rounded-bottom-0 card-header text-dark" id="simple">
		<h5 class="mt-2"><i class="fe fe-search"></i> Tìm kiếm</h5>
	</div>
	<div class="card-body">
		<div class="expanel expanel-default">
			<div class="expanel-body">
				<?php 
                    echo $this->render("_search", ["model" => $searchModel]);
                ?>
			</div>
		</div>
	</div>
</div>

<?php Pjax::begin([
    'id'=>'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="nhan-vien-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    '
                    <div class="dropdown">
						<button aria-expanded="false" aria-haspopup="true" class="btn dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="fa fa-navicon"></i></button>
						<div class="dropdown-menu tx-13" style="">
							<h6 class="dropdown-header tx-uppercase tx-11 tx-bold bg-info tx-spacing-1">
								Chọn chức năng</h6>'
                    .
                    Html::a('<i class="fas fa fa-plus" aria-hiddi="true"></i> Thêm mới', ['create'],
                        ['role'=>'modal-remote','title'=> 'Thêm mới','class'=>'dropdown-item'])
                    .
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', [''],
                        ['data-pjax'=>1, 'class'=>'dropdown-item', 'title'=>'Tải lại'])
                    .
                    Html::a('<i class="fas fa-print" aria-hidden="true"></i> In chi tiết', 
                    ['/congtrinh/cong-trinh/choose-print'], 
                        [
                          'role'=>'modal-remote-2',
                          'title'=> 'In chi tiết',
                          'class'=>'dropdown-item text-primary'
                        ])
                    /* .
                    Html::a('<i class="fas fa-file-excel" aria-hidden="true"></i> Xuất Excel', 
                        ['/congtrinh/cong-trinh/choose-excel'], 
                            [
                              'role'=>'modal-remote-2',
                              'title'=> 'Xuất Excel',
                              'class'=>'dropdown-item text-primary'
                            ]) */
                    .
                    Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa danh sách',
                        ["bulkdelete"],
                        [
                            'class'=>'dropdown-item text-secondary',
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'Xác nhận xóa?',
                            'data-confirm-message'=>'Bạn có chắc muốn xóa?'
                        ])
                    .
                    '
						</div>
					</div>
                    '.
                    '{export}'
                ],
            ],          
            'striped' => false,
            'condensed' => true,
            'responsive' => false,
            'panelHeadingTemplate'=>'<div style="width:100%;"><div class="float-start mt-2 text-primary">{title}</div> <div class="float-end">{toolbar}</div></div>',
            'panelFooterTemplate'=>'<div style="width:100%;"><div class="float-start">{summary}</div><div class="float-end">{pager}</div></div>',
            'summary'=>'Tổng: {totalCount} dòng dữ liệu',
            'panel' => [
                'headingOptions'=>['class'=>'card-header rounded-bottom-0 card-header text-dark'],
                'heading' => '<i class="typcn typcn-folder-open"></i> DANH SÁCH CÔNG TRÌNH ',
                'before'=>false,
            ],
            'export'=>[
                'options' => [
                    'class' => 'btn'
                ]
            ]
        ])?>
    </div>
    
</div>

<?php Pjax::end(); ?>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-xl modal-xxl'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
    //'size'=>Modal::SIZE_EXTRA_LARGE
])?>

<?php Modal::end(); ?>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal2',
        'tabindex' => false // important for Select2 to work properly
   ],
  // 'dialogOptions'=>['class'=>'modal-lg'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal2',
    'footer'=>'',// always need it for jquery plugin
    'size'=>Modal::SIZE_LARGE
   // 'size'=>Modal::SIZE_EXTRA_LARGE
])?>

<?php Modal::end(); ?>

<?php
    /* $searchContent = $this->render("_search", ["model" => $searchModel]);
    echo FilterFormWidget::widget(["content"=>$searchContent, "description"=>"Nhập thông tin tìm kiếm."])  */
?>
<script>
    $(document).ready(function () {
    $('#ajaxCrudModal2').on('hidden.bs.modal', function () {
        if ($('.modal.show').length) {
            $('body').addClass('modal-open'); 
        }
    });
    $('#ajaxCrudModal2').on('show.bs.modal', function () {
        $('.modal-backdrop').not(':last').css('z-index', -1); 
    }).on('hidden.bs.modal', function () {
        $('.modal-backdrop').not(':last').css('z-index', ''); 
    });
    $('#ajaxCrudModal2').appendTo('body');
});
</script>

<!-- Phần tử ẩn chứa nội dung in -->
<div style="display:none">
    <div id="print-cong-trinh2"></div>
</div>

<script>
function inChiTietCongTrinh2(idCongTrinh) {
    if (!idCongTrinh) {
        alert('Vui lòng chọn công trình.');
        return;
    }

    $.ajax({
        type: 'GET',
        url: '/congtrinh/cong-trinh/get-print-content',
        data: { id: idCongTrinh },
        success: function (data) {
            if (data.status === 'success') {
                $('#print-cong-trinh2').html(data.content);
                printCongTrinh2();
            } else {
                alert(data.message || 'Không thể tải nội dung in.');
            }
        },
        error: function (xhr, status, error) {
            alert('Lỗi khi tải nội dung in: ' + error);
        }
    });
}

function printCongTrinh2() {
    var printContents = document.getElementById('print-cong-trinh2').innerHTML;

    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0px';
    iframe.style.height = '0px';
    iframe.style.border = 'none';
    document.body.appendChild(iframe);

    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write(`
        <html>
            <head>
                <title>In công trình</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h2 { margin-bottom: 20px; }
                    p { margin: 5px 0; }
                </style>
            </head>
            <body>
                ${printContents}
            </body>
        </html>
    `);
    doc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(() => document.body.removeChild(iframe), 1000);
}
</script>