<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\congtrinh\models\ThauPhuThanhToanLs */
?>
<div class="thau-phu-thanh-toan-ls-update">

    <?= $this->render('_form', [
        'model' => $model,
        'idCongTrinh'=>$idCongTrinh 
    ]) ?>

</div>
