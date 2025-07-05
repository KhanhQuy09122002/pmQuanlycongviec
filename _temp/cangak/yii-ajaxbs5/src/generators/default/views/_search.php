<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>
	<div class="row">
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "<div class=\"col-md-4\">";
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
        echo "</div>";
    }
} ?>  
	</div>
	<?='<?php if (!Yii::$app->request->isAjax){ ?>'."\n"?>
	  	<div class="form-group">
	        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Tìm kiếm') ?>,['class' => 'btn btn-primary']) ?>
	        <?= "<?= " ?>Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?="<?php } ?>\n"?>

    <?= "<?php " ?>ActiveForm::end(); ?>
    
</div>
