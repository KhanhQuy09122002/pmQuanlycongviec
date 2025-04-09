<?php 
use app\modules\user\models\Dashboard;
use yii\bootstrap5\Modal;
use cangak\ajaxcrud\CrudAsset; 

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
   'dialogOptions'=>['class'=>'modal-xl'],
   'headerOptions'=>['class'=>'text-primary'],
   'titleOptions'=>['class'=>'text-primary'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
   'footer'=>'',// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


<div class="row">
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class=" text-center mb-2 text-primary"><i class="fa fa-industry"></i>
					</div>
					<div class="item-box-wrap">						
						<h5 class="mb-2">
							<a href="/khoahoc/khoa-hoc?menu=khoahoc">Quản lý công trình</a>
						</h5>						
						<p class="text-muted mb-0">Quản lý đơn hàng, 
							<br/>tạo báo giá, hợp đồng,...</p>
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
							<a href="/hocvien/hoc-vien?menu=hv2">Quản lý lương</a>
						</h5>
						<p class="text-muted mb-0">Quản lý lương nhân viên bóc vác, <br/>
							xuất bản lương,....</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class=" text-center text-success mb-2"><i class="fa fa-user-tie"></i>
					</div>
					<div class="item-box-wrap">
						<h5 class="mb-2">
							<a href="/giaovien/giao-vien?menu=gv1">Quản lý khách hàng</a>
						</h5>
						<p class="text-muted mb-0">Quản lý thông tin khách hàng, 
							đơn hàng, công nợ,....</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
		<div class="card custom-card service">
			<div class="card-body">
				<div class="item-box text-center">
					<div class="text-center text-warning mb-2"><i class="fa fa-truck"></i>
					</div>
					<div class="item-box-wrap">
						<h5 class="mb-2">
							<a href="/hoc-vien/quan-ly-hoc-vien?menu=qlhv">Quản lý nhà cung cấp</a>
						</h5>
						<p class="text-muted mb-0">Quản lý thông tin nhà cung cấp, 
							đơn hàng, công nợ,....</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
        <div class="card custom-card">
        	<div class="card-body" style="width: 100%; height:450px">
        		<img src="/libs/images/CongViec.jpg" alt="img" style="width: 100%; height: 100%; object-fit: cover;">
        	</div>
        </div>
    </div>
</div>

