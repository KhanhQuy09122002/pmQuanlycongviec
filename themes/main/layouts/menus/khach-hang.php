<li class="slide">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<!-- <span class="side-menu__icon"><i class="fe fe-lock side_menu_img"></i></span> -->
		<!-- <span class="side-menu__label">Quản lý tài khoản</span><i class="angle fe fe-chevron-right"></i> -->
		<span class="side-menu__label"><i class="fa fa-folder-o"></i> Quản lý khách hàng</span><i class="angle fa fa-caret-right"></i>
	</a>
	<ul class="slide-menu" data-menu="kh">
		<li class="panel sidetab-menu">
			<div class="tab-menu-heading p-0 pb-2 border-0">
				<div class="tabs-menu ">
					<ul class="nav panel-tabs">
						<li><a href="#side7" class="active" data-bs-toggle="tab"><i
									class="bi bi-house"></i>
								<p>Home</p>
							</a></li>
						<li><a href="#side8" data-bs-toggle="tab"><i class="bi bi-box"></i>
								<p>Activity</p>
							</a></li>
					</ul>
				</div>
			</div>
			<div class="panel-body tabs-menu-body p-0 border-0">
				<div class="tab-content">
					<div class="tab-pane active" id="side7">
						<ul class="sidemenu-list">
							<li class="side-menu__label1"><a href="javascript:void(0)">Danh mục chức năng</a>
							</li>
							<li><a href="<?= Yii::getAlias('@web/khachhang/khach-hang?menu=kh1') ?>" class="slide-item" data-menu="kh1"><i class="fe fe-file-text"></i> Quản lý khách hàng</a>
							</li>
                            <li><a href="<?= Yii::getAlias('@web/khachhang/don-hang-khach-hang?menu=kh2') ?>" class="slide-item" data-menu="kh2"><i class="fe fe-file-text"></i> Danh sách đơn hàng</a>
							</li>
						</ul>
						<div class="menutabs-content px-0">
							<!-- menu tab here -->
						</div>
					</div>
					<div class="tab-pane" id="side8">
						<!-- activity here -->
					</div>
				</div>
			</div>
		</li>

	</ul>
</li>