<?php 
use app\modules\user\models\Dashboard;
use yii\bootstrap5\Modal;
use cangak\ajaxcrud\CrudAsset; 
use app\modules\congtrinh\models\CongTrinh;
use app\custom\CustomFunc;


Yii::$app->params['showTopSearch'] = false;
Yii::$app->params['moduleID'] = 'Home';
Yii::$app->params['modelID'] = 'Dashboard';
CrudAsset::register($this);
$dash = new Dashboard();
?>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
    'dialogOptions'=>['class'=>'modal-xl modal-xxl'],
   'headerOptions'=>['class'=>'text-primary'],
   'titleOptions'=>['class'=>'text-primary'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
   'footer'=>'',// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<div class="row">
	<?php 
	foreach (CongTrinh::getListGhimBatDau() as $iBd=>$ghimBD){
	?>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class=" text-center mb-2 text-primary">
						<a href="/congtrinh/cong-trinh/view?id=<?= $ghimBD->id ?>" class="text-primary" role="modal-remote"><i class="fa fa-folder-open"></i></a>
					</div>
					<div class="item-box-wrap">						
						<h5 class="mb-2">
							<a href="/congtrinh/cong-trinh/view?id=<?= $ghimBD->id ?>" class="text-primary" role="modal-remote"><?= CustomFunc::getWordsLimit($ghimBD->ten_cong_trinh, 15) ?></a>
						</h5>						
						<p class="text-muted mb-0">Giá trị HĐ: <?= number_format($ghimBD->giaTriHopDong) ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<div class="row">
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class=" text-center mb-2 text-primary"><i class="fa fa-industry"></i>
					</div>
					<div class="item-box-wrap">						
						<h5 class="mb-2">
							<a href="/congtrinh/cong-trinh?menu=ct1">Quản lý công trình</a>
						</h5>						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class=" text-center text-danger mb-2"><i class="fa fa-money"></i>
					</div>
					<div class="item-box-wrap">
						<h5 class="mb-2">
							<a href="/banhang/hoa-don-ban-hang?menu=bh1">Quản lý bán hàng</a>
						</h5>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class=" text-center text-success mb-2"><i class="fa fa-truck"></i>
					</div>
					<div class="item-box-wrap">
						<h5 class="mb-2">
							<a href="/hanghoa/hang-hoa?menu=hh1">Quản lý hàng hóa</a>
						</h5>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class="text-center text-warning mb-2"><i class="fa fa-user-tie"></i>
					</div>
					<div class="item-box-wrap">
						<h5 class="mb-2">
							<a href="/khachhang/khach-hang?menu=bh2">Quản lý khách hàng</a>
						</h5>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
        <div class="card custom-card">
        	<div class="card-body" style="width: 100%; height:350px">
        		<img src="/libs/images/CongViec.jpg" alt="img" style="width: 100%; height: 100%; object-fit: cover;">
        	</div>
        </div>
    </div>
</div>


<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   //'dialogOptions'=>['class'=>'modal-lg'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
    'size'=>Modal::SIZE_EXTRA_LARGE
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

