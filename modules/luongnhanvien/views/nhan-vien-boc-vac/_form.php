<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\luongnhanvien\models\NhanVienBocVac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhan-vien-boc-vac-form">

   <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-4">
             <?= $form->field($model, 'ho_ten')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'so_dien_thoai')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
              <?= $form->field($model, 'so_cccd')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
    <div class="form-group">
        <?= $form->field($model, 'file')->label('<i class="bi bi-image-fill me-1"></i>Chọn hình ảnh')->fileInput([
            'class' => 'form-control',
            'accept' => 'image/*',
        ]) ?>

        <?php if (!$model->isNewRecord && $model->hinh_anh): ?>
            <div class="mt-2">
                <label>Ảnh hiện tại:</label><br>
                <img src="<?= Yii::getAlias('@web') . '/' . $model->hinh_anh ?>" alt="Hình ảnh" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px;" />
            </div>
        <?php endif; ?>
    </div>
</div>



        <div class="col-md-4">    
              <?= $form->field($model, 'muc_luong')->textInput() ?>
        </div>
        <div class="col-md-4">
           <?= $form->field($model, 'trang_thai')->dropDownList([
            'Đang làm việc' => 'Đang làm việc',
            'Đã nghỉ việc' => 'Đã nghỉ việc',
           ], ['prompt' => '-- Chọn trạng thái --']) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
